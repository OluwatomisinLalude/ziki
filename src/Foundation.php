<?php
namespace Ziki;

class Foundation
{

    /**
     * @param string $basePath
     */
    public function __construct($basePath)
    {
        $this->basePath = $basePath;
        $this->loadConfig();
        $this->loadTemplate();
        $this->loadInstaller();
        $this->bootstrapRouter();
    }

    private function loadConfig()
    {
        $configPath = $this->basePath . DIRECTORY_SEPARATOR . 'src/config/app.json';
        Core\Config::json($configPath);
    }

    private function loadTemplate()
    {
        $templatePath = $this->basePath . DIRECTORY_SEPARATOR . 'resources/themes' . DIRECTORY_SEPARATOR . THEME . DIRECTORY_SEPARATOR . 'templates';
        $this->template = new Core\Template($templatePath);
    }

    private function loadInstaller()
    {
        $templatePath = $this->basePath . DIRECTORY_SEPARATOR . 'resources/installation';
        $this->installer = new Core\Installer($templatePath);
    }

    private function bootstrapRouter()
    {
        $this->router = new Http\Router;
    }

    public function start() {
        require $this->basePath . DIRECTORY_SEPARATOR . 'src/config/routes.php';
        echo $this->template->render('404.html');
    }
}
