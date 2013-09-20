<?php

namespace LigaSolidariaStorage\Storage\FileManager;

use \ReflectionClass;

/**
* Test DirectoryIterator
*/
class DirectoryIteratorTest extends \PHPUnit_Framework_TestCase
{
    protected $folderTestPath;

    public function setUp()
    {
        $this->folderTestPath = $folderTestPath = __DIR__ . '/files';
        if (is_dir($folderTestPath)) {
            $this->tearDown();
        }
        mkdir($folderTestPath, 0777);
        touch($folderTestPath . '/file1.txt');
        touch($folderTestPath . '/file2.txt');
        touch($folderTestPath . '/file3.txt');
    }

    public function tearDown()
    {
        foreach (scandir($this->folderTestPath) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            unlink($this->folderTestPath . DIRECTORY_SEPARATOR . $item);
        }
        rmdir($this->folderTestPath);
    }

    public function assertPreConditions()
    {
        $class = 'LigaSolidariaStorage\Storage\FileManager\DirectoryIterator';

        $this->assertTrue(class_exists($class), 'Class not found: ' . $class);

        $instance = new DirectoryIterator;

        $this->assertInstanceOf($class, $instance);
    }

    /**
     * @covers LigaSolidariaStorage\Storage\FileManager\DirectoryIterator::setPath()
     */
    public function testSetPath()
    {
        $instance = new DirectoryIterator;

        $class = 'LigaSolidariaStorage\Storage\FileManager\DirectoryIterator';
        $reflectionClass = new \ReflectionClass($class);

        $instance->setPath($this->folderTestPath);

        $path = $reflectionClass->getProperty('path');
        $path->setAccessible(true);

        $this->assertEquals($this->folderTestPath, $path->getValue($instance));
    }

    /**
     * @covers LigaSolidariaStorage\Storage\FileManager\DirectoryIterator::setPath()
     * @expectedException InvalidArgumentException
     */
    public function testSetPathShouldException()
    {
        $instance = new DirectoryIterator;

        $instance->setPath('aaaaaa');
    }

    /**
     * @covers LigaSolidariaStorage\Storage\FileManager\DirectoryIterator::getPath()
     * @depends testSetPath
     */
    public function testGetPath()
    {
        $instance = new DirectoryIterator();
        $instance->setPath($this->folderTestPath);

        $this->assertEquals($this->folderTestPath, $instance->getPath());
    }


    /**
     * @covers LigaSolidariaStorage\Storage\FileManager\DirectoryIterator::createIterator()
     * @depends testSetPath
     */
    public function testCreateIterator()
    {
        $instance = new DirectoryIterator();
        $instance->setPath($this->folderTestPath);

        $instance->createIterator();

        $class = 'LigaSolidariaStorage\Storage\FileManager\DirectoryIterator';
        $reflectionClass = new \ReflectionClass($class);

        $instance->setPath($this->folderTestPath);

        $iterator = $reflectionClass->getProperty('iterator');
        $iterator->setAccessible(true);

        $this->assertInstanceOf(
            '\DirectoryIterator',
            $iterator->getValue($instance)
        );
    }

    /**
     * @covers LigaSolidariaStorage\Storage\FileManager\DirectoryIterator::getIterator()
     * @depends testCreateIterator
     */
    public function testGetIterator()
    {
        $instance = new DirectoryIterator();
        $instance->setPath($this->folderTestPath);

        $iterator = $instance->getIterator();

        $this->assertInstanceOf('\DirectoryIterator', $iterator);

        $this->assertSame($iterator, $instance->getIterator());
    }

    /**
     * @covers LigaSolidariaStorage\Storage\FileManager\DirectoryIterator::__construct()
     * @depends testSetPath
     * @depends testGetIterator
     */
    public function testConstruct()
    {
        $instance = new DirectoryIterator($this->folderTestPath);

        $class = 'LigaSolidariaStorage\Storage\FileManager\DirectoryIterator';
        $reflectionClass = new \ReflectionClass($class);

        $path = $reflectionClass->getProperty('path');
        $path->setAccessible(true);

        $this->assertEquals($this->folderTestPath, $path->getValue($instance));

        $iterator = $reflectionClass->getProperty('iterator');
        $iterator->setAccessible(true);

        $this->assertInstanceOf('\DirectoryIterator', $iterator->getValue($instance));
    }
}
