<?php

namespace LigaSolidariaStorage\Storage\Mailer;

use LigaSolidariaStorage\Storage\Exception\InvalidMessageException;
use Respect\Validation\Validator as v;

class Sender
{
    protected $swiftSender; 

    public function __construct($sender)
    {
        $this->swiftSender    = $sender; 
    }

    public function send(MessageInterface $message)
    {
        $this->validateMessage($message);
        return $this->swiftSender->send($message);
    }

    protected function validateMessage(MessageInterface $message)
    {
        if (!$message->getFrom()) {
            throw new InvalidMessageException('E-mail de contato vazio');
        }

        $text = trim($message->getBody());
        $bodyValidation = v::string()->notEmpty();
        if (!$bodyValidation->validate($text)) {
            throw new InvalidMessageException('Mensagem vazia');
        }
    }
}