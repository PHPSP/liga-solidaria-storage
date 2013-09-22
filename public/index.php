<?php

require __DIR__ . '/../bootstrap.php';

use Respect\Rest\Router;

$r = new Router;
$r->isAutoDispatched = false;

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

$r->always(
    'Accept',
    array(
        'text/html'        => new LigaSolidariaStorage\Routine\Twig,
        'text/plain'       => $json = new LigaSolidariaStorage\Routine\Json,
        'application/json' => $json,
        'text/json'        => $json
    )
);

print $r->run();
