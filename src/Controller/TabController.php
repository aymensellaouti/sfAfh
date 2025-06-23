<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TabController extends AbstractController
{
    #[Route('/tab/users', name: 'app_users')]
    public function users(): Response {
        $users = [
            ['firstname' => 'aymen', 'name' => 'sellaouti', 'age' => 39],
            ['firstname' => 'skander', 'name' => 'sellaouti', 'age' => 3],
            ['firstname' => 'souheib', 'name' => 'youssfi', 'age' => 59],
        ];

        return $this->render('tab/users.html.twig', ["users" => $users]);
    }
    #[Route('/tab/{nb?5}', name: 'app_tab')]
    public function index($nb): Response
    {
        $notes = [];
        for ($i = 1; $i <= $nb; ++$i) {
            $notes[] = rand(0, 20);
        }
        return $this->render('tab/index.html.twig', [
            'notes' => $notes,
        ]);
    }


    #[Route('/heritage', name: 'app_heritage')]
    public function heritage(): Response
    {
        return $this->render('tab/heritage.html.twig');
    }
}
