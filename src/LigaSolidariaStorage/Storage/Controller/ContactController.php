<?php

namespace LigaSolidariaStorage\Storage\Controller;

use Respect\Rest\Routable;
use LigaSolidariaStorage\Storage\Mailer\Sender;
use LigaSolidariaStorage\Storage\Mailer\Message;
use LigaSolidariaStorage\Storage\Exception\InvalidMessageException;

class ContactController implements Routable 
{
    const TEMPLATE = 'contact.html.twig';

    protected $sender; 

    protected $receiverMail;

    protected $receiverName;

    protected $subject;

    public function __construct($config)
    {
        $smtp = $config['smtp'];
        $port = $config['port']; 
        $ssl =  $config['ssl'] ? 'ssl' : null;
        $swiftTransport = \Swift_SmtpTransport::newInstance($smtp, $port, $ssl);
        $swiftTransport->setUsername($config['username']);
        $swiftTransport->setPassword($config['password']);
        $swiftSender = \Swift_Mailer::newInstance($swiftTransport);

        $this->receiverMail = $config['receiver_mail'];
        $this->receiverName = $config['receiver_name'];
        $this->subject      = $config['subject'];
        $this->sender = new Sender($swiftSender);
    }

    public function get()
    {
        return array(
            '_view' => self::TEMPLATE
        );
    }

    public function post()
    {
        $message = new Message();
        try {

            $message->setSubject($this->subject.' : '.$_POST['reason']);
            $message->setFrom(array($_POST['email'] => $_POST['name']));
            $message->setTo(array($this->receiverMail));
            $message->setBody($_POST['message']);

            $sent = $this->sender->send($message);
        } catch (\Swift_SwiftException $e) {
            return $this->getErrorResponse(array($e->getMessage()));
        } catch (InvalidMessageException $e) {
            return $this->getErrorResponse(array($e->getMessage()));
        }
        
        if (!$sent) {
            return $this->getErrorResponse(array('E-mail não enviado'));
        }
        $response = array(
            '_view'   => self::TEMPLATE,
            'success' => 'Email enviado com sucesso!',
        );

        return $response;
    }

    protected function getErrorResponse($messages)
    {
        header('HTTP/1.1 406');   
        $response = array( 
            '_view'  => self::TEMPLATE ,
            'errors' => $messages
        );
        
        return $response;
    }
}