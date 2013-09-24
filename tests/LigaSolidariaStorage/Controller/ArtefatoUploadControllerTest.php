<?php

namespace LigaSolidariaStorage\Controller;

use LigaSolidariaStorage\Storage\Controller\ArtefatoUploadController;

class ArtefatoUploadControllerTest extends \PHPUnit_Framework_TestCase
{
    public function assertPreconditions()
    {
        $class = 'LigaSolidariaStorage\Storage\Controller\ArtefatoUploadController';

        $instance = new ArtefatoUploadController();

        $this->assertInstanceOf($class, $instance);
        $this->assertTrue(class_exists($class), 'Class not found: ' . $class);
    }

    public function testGetShouldWork()
    {
        $controller = new ArtefatoUploadController();

        $response = $controller->get();

        $this->assertTrue(is_array($response));
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Arquivo de upload não encontrado.
     */
    public function testFilesServerVariableEmptyOnFileUploadMustFail()
    {
        $controller = new ArtefatoUploadController();

        $response = $controller->post();
    }

    /**
     * @expectedException        RuntimeException
     * @expectedExceptionMessage Houve um problema ao enviar seu arquivo, tente novamente.
     */
    public function testFakeFileUploadMustFail()
    {
        $_FILES = array('artefato' => array('name' => 'test.txt', 'tmp_name' => __DIR__ . '/../testfile.txt'));
        
        $controller = new ArtefatoUploadController();

        $response = $controller->post();
    }
}