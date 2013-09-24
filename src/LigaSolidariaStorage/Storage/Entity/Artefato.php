<?php

namespace LigaSolidariaStorage\Storage\Entity;

use LigaSolidariaStorage\Storage\Exception\FileNotFoundException;

/**
 * Class Artefato
 */
class Artefato
{
    /**
     * @var string
     */
    private $file;

    /**
     * Conctructor
     * 
     * @param string $file The full path with filename
     */
    public function __construct($file)
    {
        if (! file_exists($file)) {
            throw new FileNotFoundException("Arquivo não encontrado.", 404);
        }

        $this->file = $file;
    }

    /**
     * Get file
     * 
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Get file info
     * 
     * @return \SplFileInfo
     */
    public function getFileInfo()
    {
        return new \SplFileInfo($this->file);
    }
}