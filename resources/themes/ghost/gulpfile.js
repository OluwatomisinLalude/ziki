"use strict";
// Gulp Config
const devBuild =
    (process.env.NODE_ENV || "development").trim().toLowerCase() ===
    "development",
  dir = {
    templates: "templates/**/*.html",
    src: "assets/",
    build: "build/"
  },
  // Node Modules
  gulp = require("gulp"),
  noop = require("gulp-noop"),
  newer = require("gulp-newer"),
  imagemin = require("gulp-imagemin"),
  cache = require("gulp-cache"),
  cleancss = require("gulp-clean-css"),
  concat = require("gulp-concat-css"),
  autoprefixer = require("autoprefixer"),
  postcss = require("gulp-postcss"),
  assets = require("postcss-assets"),
  mqpacker = require("css-mqpacker"),
  cssnano = require("cssnano"),
  php = require("gulp-connect-php"),
  sourcemaps = devBuild ? require("gulp-sourcemaps") : null,
  browsersync = devBuild ? require("browser-sync").create() : null;

// Optimize Images
const imgConfig = {
  src: dir.src + "img/**/*",
  build: dir.build + "img/"
};
const optimizeImages = () => {
  return gulp
    .src(imgConfig.src)
    .pipe(newer(imgConfig.build))
    .pipe(cache(imagemin({ optimizationLevel: 5 })))
    .pipe(gulp.dest(imgConfig.build));
};

// Watch html not working on phpserver
const overwatch = () => {
  return gulp.src(dir.templates).pipe(browsersync.stream());
};
// Combine css files into one main css file
const cssConfig = {
  src: dir.src + "css/**/*",
  build: dir.build
};
const processCSS = () => {
  var postCssOpts = [
    assets({ loadPaths: [dir.src + "images/"] }),
    autoprefixer({ browsers: ["last 2 versions", "> 2%"] }),
    mqpacker
  ];

  if (!devBuild) {
    postCssOpts.push(cssnano);
  }

  return gulp
    .src(cssConfig.src)
    .pipe(sourcemaps ? sourcemaps.init() : noop())
    .pipe(cleancss())
    .pipe(postcss(postCssOpts))
    .pipe(concat("main.css"))
    .pipe(sourcemaps ? sourcemaps.write() : noop())
    .pipe(gulp.dest(cssConfig.build))
    .pipe(browsersync.stream());
};

// BrowserSync Config
const syncConfig = {
  server: {
    proxy: "localhost:8000",
    port: 9000,
    baseDir: "./",
    open: true,
    notify: false
  }
};

function reload(done) {
  browsersync.reload();
  done();
}

// Tasks
const phpserver = () => {
  return php.server({ port: 8000, keepalive: true });
};

const build = gulp.series(optimizeImages, processCSS);

// const servephp = () => gulp.parallel(phpserver, serve);

gulp.task("server", phpserver);

// Watch for changes
const watchFiles = () => {
  return (
    gulp.watch(dir.templates, gulp.series(overwatch, reload)),
    gulp.watch(imgConfig.src, gulp.series(optimizeImages, reload)),
    gulp.watch(cssConfig.src, gulp.series(processCSS, reload))
  );
};
const serve = () => browsersync.init(syncConfig);
gulp.task("start", gulp.parallel(watchFiles, gulp.series(phpserver, serve)));
