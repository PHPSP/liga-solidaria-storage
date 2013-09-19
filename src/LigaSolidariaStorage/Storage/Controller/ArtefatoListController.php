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
            return $fullPath;
        }

        if (!is_dir($fullPath)) {
            return 'Pasta/arquivo não encontrado';
        }
        $directory = new DirectoryIterator($fullPath);



        $output = '<h1>Arquivos</h1>';
        $output .= '<ul>';
        foreach ($directory->getIterator() as $item) {
            if ($item->isDot()) {
                continue;
            }
            $output .= '<li>' . $item->getFilename() . '</li>';
        }
        $output .= '</ul>';

        return $output;
    }
}
