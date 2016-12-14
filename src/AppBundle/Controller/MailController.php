<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpKernel\Exception\HttpException;

class MailController extends Controller{

    private $mailer;

    public function __construct( $mailer )
    {
        $this->mailer = $mailer;
    }

    public function sendAction ( $object, $to = '', $from = '', $message = "" )
    {
        // Test des paramètres


        // Utilisation de Swift
        $message = \Swift_Message::newInstance()
            ->setSubject( $object )
            ->setFrom( $from )
            ->setTo( $to )
            ->setBody( $message );


        // Utilisation du service Mailer
        $this->mailer->send($message);

        return array();
    }
}