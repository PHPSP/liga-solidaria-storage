<?php

namespace LigaSolidariaStorage\Storage\Mailer;

class SenderTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @test
    * @expectedException \LigaSolidariaStorage\Storage\Exception\InvalidMessageException
    */ 
    public function shouldNotSendEmailWithoutBody()
    {
        $transportSender = $this->getMockBuilder('\Swift_Sender')
            ->disableOriginalConstructor()
            ->getMock();
        $sender = new Sender($transportSender);
        $message = new Message();
        $message->setSubject('PHPSP rocks!');
        $message->setFrom(array('foo@phpsp.org.br' => 'foo bar'));
        $message->setTo(array('foo@bar.com.br'));
        // without body: $message->setBody('');

        $sender->send($message);
    }

    /**
    * @test
    * @expectedException \LigaSolidariaStorage\Storage\Exception\InvalidMessageException
    */ 
    public function shouldNotSendEmailWithBodyOnlySpaces()
    {
        $transportSender = $this->getMockBuilder('\Swift_Sender')
            ->disableOriginalConstructor()
            ->getMock();
        $sender = new Sender($transportSender);
        $message = new Message();
        $message->setSubject('PHPSP rocks!');
        $message->setFrom(array('foo@phpsp.org.br' => 'foo bar'));
        $message->setTo(array('foo@bar.com.br'));
        $message->setBody('  ');

        $sender->send($message);   
    }

    /**
    * @test
    * @expectedException \Swift_SwiftException
    */ 
    public function shouldNotSendEmailWithoutFromEmail()
    {
        $transportSender = $this->getMockBuilder('\Swift_Sender')
            ->disableOriginalConstructor()
            ->getMock();
        $sender = new Sender($transportSender);
        $message = new Message();
        $message->setSubject('PHPSP rocks!');
        $message->setFrom(array('foo' => 'foo bar'));
        $message->setTo(array('foo@bar.com.br'));
        $message->setBody('  ');

        $sender->send($message);   
    }

    /**
    * @test
    * @expectedException \Swift_SwiftException
    */ 
    public function shouldNotSendEmailWithoutToEmail()
    {
        $transportSender = $this->getMockBuilder('\Swift_Sender')
            ->disableOriginalConstructor()
            ->getMock();
        $sender = new Sender($transportSender);
        $message = new Message();
        $message->setSubject('PHPSP rocks!');
        $message->setFrom(array('foo@phpsp.org.br' => 'foo bar'));
        $message->setTo(array('foo'));
        $message->setBody('  ');

        $sender->send($message);   
    }

    /**
    * @test
    */ 
    public function shouldSendEmail()
    {
        $transportSender = $this->getMockBuilder('\Swift_Sender')
            ->disableOriginalConstructor()
            ->setMethods(array('send'))
            ->getMock();

        $transportSender->expects($this->once())
            ->method('send')
            ->will($this->returnValue(true));

        $sender = new Sender($transportSender);
        $message = new Message();
        $message->setSubject('PHPSP rocks!');
        $message->setFrom(array('foo@phpsp.org.br' => 'foo bar'));
        $message->setTo(array('foo@bar.com.br'));
        $message->setBody('foobar');

        $this->assertTrue($sender->send($message));
    }

}