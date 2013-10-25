<?php

namespace LigaSolidariaStorage\Storage\Controller;

use Respect\Rest\Routable;
use \InvalidArgumentException as Argument;

class Login implements Routable
{
    public function get()
    {
        return array('_view' => 'login.html.twig');
    }

    public function post()
    {
        try {
            $vars   = array('_view'=>'index.html.twig');
            $email = filter_input(INPUT_POST, 'email');
            $pass = filter_input(INPUT_POST, 'password');

            if (empty($email) || empty($pass)) {
                throw new Argument('Email ou senha inválidos');
            }

            $_SESSION['email'] = $_POST['email'];

            header('Location: /');

        } catch(Argument $e) {
            $vars['message'] = $e->getMessage();
            return $vars;
        }
    }
}
