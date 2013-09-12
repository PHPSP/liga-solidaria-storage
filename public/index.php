<?php

require __DIR__ . '/../bootstrap.php';

use Respect\Rest\Router;

$r = new Router;

$r->any(
    '/**',
    function () {
        return 'Olá!';
    }
);
