<?php

namespace LigaSolidariaStorage\Routine;

use Respect\Config\Container;
use Twig_Environment;

/**
 * Convert data to HTML using Twig
 */
class Twig
{
    /**
     * @param Twig_Environment $twig
     * @return Twig_Environment
     */
    public function __construct(Twig_Environment $twig = null)
    {
        if (is_null($twig)) {
            $container = new Container(CONFIG_DIR . '/config.ini');
            $twig = $container->twig;
        }
        $this->twig = $twig;
        return $twig;
    }

    /**
     * @param  mixed $data
     * @return string|array
     */
    public function __invoke($data = null)
    {
        if (is_string($data)) {
            return $data;
        }
        if (is_null($data)) {
            return '';
        }

        if (!is_array($data) || !isset($data['_view'])) {
            return $data;
        }

        $view = $data['_view'];
        unset($data['_view']);
        return $this->twig->render($view, $data);
    }
}
