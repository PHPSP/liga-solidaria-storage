<?php

require __DIR__ . '/../bootstrap.php';

use Respect\Rest\Router;

$r = new Router;

$r->get('/list', function () {
    return '<h1>Listagem</h1>';
});

$r->any('/upload', 'LigaSolidariaStorage\Storage\Controller\ArtefatoUploadController');

$r->any(
    '/**',
    function () {
        return 'Olá!';
    }
);
