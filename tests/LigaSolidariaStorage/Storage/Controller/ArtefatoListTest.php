<?php

namespace LigaSolidariaStorage\Storage\Controller;

use LigaSolidariaStorage\Storage\Controller\ArtefatoList;

/**
* Test class ArtefatoList
*/
class ArtefatoListTest extends \PHPUnit_Framework_TestCase
{
    public function assertPreConditions()
    {
        $class = 'LigaSolidariaStorage\Storage\Controller\ArtefatoList';

        $this->assertTrue(class_exists($class), 'Class not found: ' . $class);

        $instance = new ArtefatoList;

        $this->assertInstanceOf($class, $instance);
    }

    public function testGetShouldWork()
    {

        $instance = new ArtefatoList;

        $this->assertTrue($instance->get());
    }
}