<?php

namespace LigaSolidariaStorage\Routine;

use \PHP_SESSION_ACTIVE;

class Auth
{
    public function __construct()
    {
        session_start();
    }

    public function __invoke()
    {
        if (isset($_SESSION['email']))
            return true;

        header('HTTP/1.1 403 Permission denied');
        header('Location: /login');
        return false;
    }
}
