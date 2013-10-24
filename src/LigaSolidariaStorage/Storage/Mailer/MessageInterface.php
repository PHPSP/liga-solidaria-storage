<?php

namespace LigaSolidariaStorage\Storage\Mailer;

interface MessageInterface
{
    public function setFrom($addresses, $name = null);

    public function setBody($body);

    public function setTo($addresses, $name = null);

    public function setSubject($subject);
}