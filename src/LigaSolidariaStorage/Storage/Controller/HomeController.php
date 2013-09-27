<?php

namespace LigaSolidariaStorage\Storage\Controller;

use Respect\Rest\Routable;

class HomeController implements Routable
{
    public function get()
    {
        return array('_view' => 'index.html.twig');
    }
}
