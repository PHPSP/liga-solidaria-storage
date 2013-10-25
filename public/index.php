<?php

require __DIR__ . '/../bootstrap.php';

use Respect\Rest\Router;

$auth = new LigaSolidariaStorage\Routine\Auth;
$authenticated = function() use($auth) {return $auth();};
$r = new Router;
$r->isAutoDispatched = false;

$r->any('/login', 'LigaSolidariaStorage\Storage\Controller\Login');

$r->any('/', 'LigaSolidariaStorage\Storage\Controller\HomeController')
        ->by($authenticated);

$r->get('/list/*', 'LigaSolidariaStorage\Storage\Controller\ArtefatoListController' )
        ->by($authenticated);

$r->any('/upload', 'LigaSolidariaStorage\Storage\Controller\ArtefatoUploadController')
        ->by($authenticated);
$r->any('/contact', 'LigaSolidariaStorage\Storage\Controller\ContactController', array($c->mailer));

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
