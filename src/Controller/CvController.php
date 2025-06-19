<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CvController extends AbstractController
{
    #[Route('/cv/{name}/{firstname}/{age}/{section}', name: 'app_cv')]
    public function index($name, $firstname, $age, $section): Response
    {
        return $this->render('cv/index.html.twig', [
            'name' => $name,
            'firstname' => $firstname,
            'age' => $age,
            'section' => $section,
        ]);
    }
}
