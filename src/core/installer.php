<?php
namespace Ziki\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Installer
{
    private $twig;

    public function __construct($templatePath)
    {
        $this->twig = new Environment(new FilesystemLoader($templatePath), $this->setTwigCaching());
    }

    public function render($page, array $parameters = [])
    {
        return $this->twig->render($page, $parameters);
    }

    private function setTwigCaching()
    {
        $data = [];

        if (ZIKI_PROD) {
            $data = [
                'auto_reload' => true,
                'cache' => ZIKI_BASE_PATH . '/storage/cache/views',
            ];
        } else {
                $data = [
                    'auto_reload' => true,
                    'cache' => false,
                ];
            }
        return $data;
    }
}
