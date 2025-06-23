<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

final class CvController extends AbstractController
{
    #[Route(
        '/cv/{name}/{firstname}/{local<fr|ar|en>}/{age<\d{1,2}>?24}/{section<[a-z]+>?AFH}',
        name: 'app_cv',
        //defaults: ["section" => "GL"]

    )]
    public function index($name, $firstname, $age, $section, SessionInterface $session): Response
    {
        if($age < 65) {
            $this->addFlash('success', 'Rak Mazelt Chabeb :D');
        }

        //return $this->redirectToRoute('')
        return $this->render('cv/index.html.twig', [
            'name' => $name,
            'firstname' => $firstname,
            'age' => $age,
            'section' => $section,
        ]);
    }
}
