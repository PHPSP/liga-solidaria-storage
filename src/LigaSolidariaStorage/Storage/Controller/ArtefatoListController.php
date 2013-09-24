<?php

namespace LigaSolidariaStorage\Storage\Controller;

use LigaSolidariaStorage\Storage\FileManager\DirectoryIterator;
use Respect\Rest\Routable;

/**
* Lista os Artefatos
*/
class ArtefatoListController implements Routable
{
    public function get($path = null)
    {
        $fullPath = UPLOAD_DIR . '/' . $path;

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
            return 'Pasta/arquivo não encontrado';
        }
        $directory = new DirectoryIterator($fullPath);

        return array(
            'iterator' => $directory->getIterator(),
            '_view' => 'file_manager.html.twig'
        );
    }
}
