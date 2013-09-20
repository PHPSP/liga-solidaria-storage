<?php

require __DIR__ . '/../bootstrap.php';

use Respect\Rest\Router;

$r = new Router;
$r->isAutoDispatched = false;

$r->get('/list/*', 'LigaSolidariaStorage\Storage\Controller\ArtefatoListController' );

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
