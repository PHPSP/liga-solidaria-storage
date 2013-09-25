<?php

require __DIR__ . '/../bootstrap.php';

use Respect\Rest\Router;

// Esta closure esta aqui somente para reutilizarmos nas
// chamadas do Router o ideal seria termos uma classe
// de autenticacao e o codigo separado, como não há tempo
// ficou assim, por enquanto...
$isauth = function ($user, $pass) use ($c) {
    
    $authenticated = $user === $c->user && $pass === $c->pass;
    
    if (!$authenticated) {
        header('HTTP/1.1 401');
        header("WWW-Authenticate: Basic realm=\"Login\"");
    
        exit('Login cancelado');
    }
    return $authenticated;
};

$r = new Router;
$r->isAutoDispatched = false;

$r->get('/list/*', 'LigaSolidariaStorage\Storage\Controller\ArtefatoListController' )
        ->authBasic('Acesso', $isauth);

$r->any('/upload', 'LigaSolidariaStorage\Storage\Controller\ArtefatoUploadController')
        ->authBasic('Acesso', $isauth);


$r->any(
    '/**',
    function () {
        header('Location: /list');
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
