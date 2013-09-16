<?php

namespace LigaSolidariaStorage\Entity;

use LigaSolidariaStorage\Storage\Entity\Artefato;

class ArtefatoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException        LigaSolidariaStorage\Storage\Exception\FileNotFoundException
     * @expectedExceptionMessage Arquivo não encontrado.
     * @expectedExceptionCode    404
     */
    public function testArtefatoCreationWithInexistentFileMustFail()
    {
        $file = __DIR__ . '/../invalidfile.txt';

        $artefato = new Artefato($file);
    }

    public function testArtefatoCreationWithExistentFile()
    {
        $file = __DIR__ . '/../testfile.txt';

        $artefato = new Artefato($file);
        
        $this->assertSame($file, $artefato->getFile());
    }

    public function testArtefatoGetFileInfo()
    {
        $file = __DIR__ . '/../testfile.txt';

        $artefato = new Artefato($file);

        $this->assertInstanceOf('\SplFileInfo', $artefato->getFileInfo());
    }
}