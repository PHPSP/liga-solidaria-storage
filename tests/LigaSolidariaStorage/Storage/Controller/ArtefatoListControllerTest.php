<?php

namespace LigaSolidariaStorage\Storage\Controller;

use LigaSolidariaStorage\Storage\Controller\ArtefatoListController;

/**
* Test ArtefatoListController
*/
class ArtefatoListControllerTest extends \PHPUnit_Framework_TestCase
{

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
}
