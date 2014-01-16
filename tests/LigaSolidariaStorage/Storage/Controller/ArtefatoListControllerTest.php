<?php

namespace LigaSolidariaStorage\Storage\Controller;

use LigaSolidariaStorage\Storage\Controller\ArtefatoListController;

/**
 * Test ArtefatoListController
 */
class ArtefatoListControllerTest extends \PHPUnit_Framework_TestCase
{

    protected $folderTestPath;

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

        $instance = new ArtefatoListController(sys_get_temp_dir());

        $this->assertInstanceOf($class, $instance);
        $this->assertTrue(class_exists($class), 'Class not found: ' . $class);
    }

    public function testGetWithInvalidPathShouldError()
    {
        $_SERVER['REQUEST_URI'] = 'aaaaaaa.txt';

        $instance = new ArtefatoListController(sys_get_temp_dir());

        $response = $instance->get('aaaaaaa');

        $this->assertSame('Pasta/arquivo '.sys_get_temp_dir().'/'.$_SERVER['REQUEST_URI'].' não encontrado', $response);
    }

    /**
     * @covers LigaSolidariaStorage\Storage\Controller\ArtefatoListController::get()
     */
    public function testGetShouldWork()
    {

        $_SERVER['REQUEST_URI'] = '';

        $instance = new ArtefatoListController(sys_get_temp_dir());

        $response = $instance->get();

        $this->assertTrue(is_array($response));
    }
}
