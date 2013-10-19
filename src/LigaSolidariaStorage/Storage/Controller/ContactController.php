<?php

namespace LigaSolidariaStorage\Storage\Controller;

use Respect\Rest\Routable;

class ContactController implements Routable 
{
    public function get()
    {
        return array(
            '_view' => 'contact.html.twig'
        );
    }
}