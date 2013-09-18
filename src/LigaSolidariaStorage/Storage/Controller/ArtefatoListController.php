<?php

namespace LigaSolidariaStorage\Storage\Controller;

use LigaSolidariaStorage\Storage\FileManager\DirectoryIterator;
use Respect\Rest\Routable;


/**
* Lista os Artefatos
*/
class ArtefatoListController implements Routable
{
	private $listRoute;

    public function __contruct(Routable $listRoute)
    {
        $this->listRoute = $listRoute;
    }
    
    public function get($path = null)
    {
    	$fullPath = UPLOAD_DIR . '/' . $path;
    	$directory = new DirectoryIterator($fullPath);

    	$content = $directory->getContent();

    	$output = '<h1>Arquivos</h1>' . 
    		'<ul><li>' . implode('</li><li>', $content) . '</li></ul>';


        return $output;
    }
}
