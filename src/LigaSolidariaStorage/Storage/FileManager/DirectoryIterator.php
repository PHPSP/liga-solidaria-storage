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
			$this->iterator = new \DirectoryIterator($this->getPath());
		}
		return $this->iterator;
	}

	public function scan()
	{
		foreach ($this->getIterator() as $item) {
			if ($item->isDot()) {
				continue;
			}
			if ($item->isFile()) {
				$this->content['files'][] = $item;
			}
			if ($item->isDir()) {
				$this->content['folders'][] = $item;
			}
		}
		$this->isScanned = true;
	}

	public function rescan()
	{
		$this->scan();
	}

	public function getFiles()
	{
		if ($this->isScanned === false) {
			$this->scan();
		}
		return $this->content['files'];
	}

	public function getFolders()
	{
		if ($this->isScanned === false) {
			$this->scan();
		}
		return $this->content['folders'];
	}

	public function getContent()
	{
		return array_merge($this->getFolders(), $this->getFiles());
	}

}
