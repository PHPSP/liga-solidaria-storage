<?php

namespace LigaSolidariaStorage\Storage\Controller;

use LigaSolidariaStorage\Storage\FileManager\DirectoryIterator;
use Respect\Rest\Routable;

/**
* Lista os Artefatos
*/
class ArtefatoListController implements Routable
{
    private $uploadDir; 

    public function __construct($uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    public function get($path = null)
    {
        $pathWithExtension = "{$path}." .
            pathinfo($_SERVER['REQUEST_URI'], PATHINFO_EXTENSION);
        $fullPath = $this->uploadDir . '/' . $pathWithExtension;

        if (is_file($fullPath)) {
            header('Content-Disposition: attachment; filename="' . basename($fullPath) . '"');
            header("Content-Type: application/octet-stream");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . filesize($fullPath));
            header("Connection: close");
            readdir($fullPath);

            return null;
        }

        if (!is_dir($fullPath)) {
            return sprintf('Pasta/arquivo %s não encontrado', $fullPath);
        }
        $directory = new DirectoryIterator($fullPath);

        return array(
            'iterator' => $directory->getIterator(),
            '_view' => 'file_manager.html.twig'
        );
    }
}
