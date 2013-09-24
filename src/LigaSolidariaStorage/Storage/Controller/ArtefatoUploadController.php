<?php

namespace LigaSolidariaStorage\Storage\Controller;

use Respect\Rest\Routable;

class ArtefatoUploadController implements Routable
{
    public function get()
    {
        return array(
            '_view' => 'file_upload.html.twig'
        );
    }

    public function post()
    {
        if (empty($_FILES)) {
            throw new \InvalidArgumentException("Arquivo de upload não encontrado.", 1);
        }

        $artefato = $_FILES['artefato'];
        $this->moveUploadedFile($artefato);

        header('Location: /list');
    }

    private function moveUploadedFile($artefato)
    {
        if (!move_uploaded_file($artefato['tmp_name'], UPLOAD_DIR . DIRECTORY_SEPARATOR . $artefato['name'])) {
            throw new \RuntimeException("Houve um problema ao enviar seu arquivo, tente novamente.", 2);
        }

        return true;
    }
}