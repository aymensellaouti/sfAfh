<?php

namespace App\Controller;

use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class FirstController extends AbstractController
{
    public function __construct(private MailerService $mailerService)
    {

    }
    #[Route('/email/test')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $this->mailerService->sendMAil();
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
