<?php

require __DIR__ . '/../bootstrap.php';

use Respect\Rest\Router;

$r = new Router;

$r->get('/list/*', 'LigaSolidariaStorage\Storage\Controller\ArtefatoListController' );

$r->any(
    '/**',
    function () {
        return 'Olá!';
    }
);
