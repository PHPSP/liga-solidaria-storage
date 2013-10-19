<?php

require __DIR__ . '/../bootstrap.php';

use Respect\Rest\Router;

$r = new Router;
$r->isAutoDispatched = false;

$r->any('/', 'LigaSolidariaStorage\Storage\Controller\HomeController');

$r->get('/list/*', 'LigaSolidariaStorage\Storage\Controller\ArtefatoListController' );

$r->any('/upload', 'LigaSolidariaStorage\Storage\Controller\ArtefatoUploadController');

$r->any('/contact', 'LigaSolidariaStorage\Storage\Controller\ContactController');

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
