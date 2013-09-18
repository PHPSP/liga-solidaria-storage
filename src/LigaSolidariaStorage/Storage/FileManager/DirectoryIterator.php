<?php

namespace LigaSolidariaStorage\Storage\FileManager;

/**
* Iterata pastas e retorna seu conteudo
*/
class DirectoryIterator
{
    protected $path;
    protected $iterator;
    protected $content;
    protected $isScanned;

    public function __construct($path = null)
    {
        $this->content['files'] = array();
        $this->content['folders'] = array();

        if (!empty($path)) {
            $this->setPath($path);
            $this->getIterator();
        }
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        if(!is_dir($path)){
            throw new \InvalidArgumentException(
                "Directory " . $path . " not found."
            );
        }
        $this->path = $path;
    }

    public function getIterator()
    {
        if (empty($this->iterator)) {
            $this->createIterator();
        }
        return $this->iterator;
    }

    public function createIterator()
    {
        $this->iterator = new \DirectoryIterator($this->getPath());
    }

}
