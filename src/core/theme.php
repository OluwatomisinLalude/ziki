<?php

use Symfony\Component\Finder\Finder;

class Theme
{

    public $themes_path = 'resources/themes';
    public $finder;

    public function __construct()
    {
        $this->finder =  new Finder();
    }

    public function get_themes_dir()
    {
        $dirs = $this->finder->directories()->in($this->themes_path)->depth('< 1');
        $dir_path_array = [];

        if (!$dirs->hasResults()) {
                return false;
            }

        foreach ($dirs as $dir) {
                $dir_path_array[] = $dir->getRealPath();
            }

        return $dir_path_array;
    }

    public function get_themeJsonFile()
    {
        $themes_dir = $this->get_themes_dir();

        $files = [];
        foreach ($themes_dir as $theme_dir) {

                $files = $this->finder->files()->in($theme_dir)->name('theme.json');
                if (!$files->hasResults()) {
                        return false;
                    }

                $files[] = $files;
            }

        $themeJson_files_array = [];

        foreach ($files[0] as $file) {
                $themeJson_files_array[] = $file->getRealPath();
            }

        return $themeJson_files_array;
    }

    public  function all()
    {
        $get_themeJsonFiles = $this->get_themeJsonFile();
        $resultContent = [];

        foreach ($get_themeJsonFiles as $get_themeJsonFile) {
                $fileContent = file_get_contents($get_themeJsonFile);
                if (!empty($fileContent))
                    $resultContent[] = json_decode($fileContent, true);
            }

        return $resultContent;
    }

    public function activate($theme)
    {
        $themePath = ZIKI_BASE_PATH . '/resources/themes/' . $theme;
        if (!is_dir($themePath) || !file_exists($themePath)) {
                return false;
            }

        $themeConfigPath = ZIKI_BASE_PATH . '/src/config/app.json';
        $ConfigContent = '{
            "APP_NAME": "Ziki App",
            "THEME":"' . $theme . '",
            "ZIKI_CACHE_ENABLED": true,
            "ZIKI_DEBUG_ENABLED": false,
            "ZIKI_PROD" : false
        }';

        $content = json_decode(file_get_contents($themeConfigPath), true);

        if ($theme !== $content['THEME']) {
                file_put_contents($themeConfigPath, $ConfigContent);
                return true;
            } else {
                return false;
            }
    }
}
