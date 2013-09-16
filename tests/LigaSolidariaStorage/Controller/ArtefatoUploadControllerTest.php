<?php

namespace LigaSolidariaStorage\Controller;

use LigaSolidariaStorage\Storage\Controller\ArtefatoUploadController;

class ArtefatoUploadControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testUploadForm()
    {
        $controller = new ArtefatoUploadController();

        $response = $controller->get();

        $form = array(
          'tag'        => 'form',
          'attributes' => array('action' => '/upload', 'method' => 'post'),
          'descendant' => array('tag' => 'input', 'attributes' => array('name' => 'artefato'))
        );

        $this->assertTag($form, $response);
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