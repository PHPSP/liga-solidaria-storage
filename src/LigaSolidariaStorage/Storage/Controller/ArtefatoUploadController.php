<?php

namespace LigaSolidariaStorage\Storage\Controller;

use Respect\Rest\Routable;

class ArtefatoUploadController implements Routable
{
    private $listRoute;

    public function __contruct(Routable $listRoute)
    {
        $this->listRoute = $listRoute;
    }

    public function get()
    {
        return '<form action="/upload" method="post" enctype="multipart/form-data">
                    <input type="file" name="artefato" />
                    <input type="submit" value="Incluir" />
                </form>';
    }

    public function post()
    {
        if (empty($_FILES)) {
            throw new \InvalidArgumentException("Arquivo de upload não encontrado.", 1);
        }

        $artefato = $_FILES['artefato'];
        $this->validateFile($artefato);
        $this->moveUploadedFile($artefato);

        header('Location: /list');
    }

    private function validateFile($artefato)
    {
        return true;
    }

    private function moveUploadedFile($artefato)
    {
        if (! move_uploaded_file($artefato['tmp_name'], UPLOAD_DIR . DIRECTORY_SEPARATOR . $artefato['name'])) {
            throw new \RuntimeException("Houve um problema ao enviar seu arquivo, tente novamente.", 2);
        }

        return true;
    }
}