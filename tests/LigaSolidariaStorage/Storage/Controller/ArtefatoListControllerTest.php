<?php

namespace LigaSolidariaStorage\Storage\Controller;

use LigaSolidariaStorage\Storage\Controller\ArtefatoListController;

/**
* Test ArtefatoListController
*/
class ArtefatoListControllerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->folderTestPath = $folderTestPath = UPLOAD_DIR . '/test_files';
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
    public function assertPreconditions()
    {
        $class =
            'LigaSolidariaStorage\Storage\Controller\ArtefatoListController';

        $instance = new ArtefatoListController();

        $this->assertInstanceOf($class, $instance);
        $this->assertTrue(class_exists($class), 'Class not found: ' . $class);
    }

    public function testGetWithInvalidPathShouldError()
    {
        $instance = new ArtefatoListController();

        $response = $instance->get('aaaaaaaa');

        $this->assertSame('Pasta/arquivo não encontrado', $response);
    }

    /**
     * @covers LigaSolidariaStorage\Storage\Controller\ArtefatoListController::get()
     */
    public function testGetShouldWork()
    {
        $instance = new ArtefatoListController();

        $response = $instance->get('/test_files');

        $this->assertTrue(is_array($response));
    }
}
