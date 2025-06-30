<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class FirstController extends AbstractController
{
    #[Route('/email/test')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('aymen.noreply.please@gmail.com')
            ->to('aymen.sellaouti@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);
        return  new Response('<body><html><h1>Email sent</h1></body></html>');
        // ...
    }
    #[Route('/hello/{name}', name: 'app_hello')]
    public function hello($name, Request $request): Response
    {
        dump($request);
        return $this->render('first/test.html.twig', [
            "message" => "Hello AFH :D",
            "name" => $name
        ]);
    }
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
}
