<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/todo')]
final class TodoController extends AbstractController
{
    #[Route('/', name: 'todo')]
    public function index(Request $request, SessionInterface $session): Response
    {
        // Afficher notre tableau de todo
        // sinon je l'initialise puis j'affiche
        if (!$session->has('todos')) {
            $todos =[
                'achat'=>'acheter clé usb',
                'cours'=>'Finaliser mon cours',
                'correction'=>'corriger mes examens'
            ];
            $session->set('todos', $todos);
            $this->addFlash('info', "La liste des todos vient d'être initialisée");
        }
        // si j ai mon tableau de todo dans ma session je ne fait que l'afficher
        return $this->render('todo/index.html.twig');
    }
    #[Route(
        '/add/{name}/{content}',
        name: 'todo.add'
    )]
    public function addTodo(SessionInterface $session, $name, $content): RedirectResponse
    {
        // Vérifier si j ai mon tableau de todo dans la session
        if ($session->has('todos')) {
            // si oui
            // Vérifier si on a déjà un todd avec le meme name
            $todos = $session->get('todos');
            if (isset($todos[$name])) {
                // si oui afficher erreur
                $this->addFlash('error', "Le todo d'id $name existe déjà dans la liste");
            } else {
                // si non on l'ajouter et on affiche un message de succès
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash('success', "Le todo d'id $name a été ajouté avec succès");
            }
        } else {
            // si non
            // afficher une erreur et on va redirger vers le controlleur index
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");
        }
        return $this->redirectToRoute('todo');
    }
    #[Route('/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(SessionInterface $session, $name, $content): RedirectResponse {
        // Vérifier si j ai mon tableau de todo dans la session
        if ($session->has('todos')) {
            // si oui
            // Vérifier si on a déjà un todd avec le meme name
            $todos = $session->get('todos');
            if (!isset($todos[$name])) {
                // si oui afficher errerur
                $this->addFlash('error', "Le todo d'id $name n'existe pas dans la liste");
            } else {
                // si non on l'ajouter et on affiche un message de succès
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash('success', "Le todo d'id $name a été modifié avec succès");
            }
        } else {
            // si non
            // afficher une erreur et on va redirger vers le controlleur index
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");
        }
        return $this->redirectToRoute('todo');
    }
    #[Route('/delete/{name}', name: 'todo.delete')]
    public function deleteTodo(SessionInterface $session, $name): RedirectResponse {
        // Vérifier si j ai mon tableau de todo dans la session
        if ($session->has('todos')) {
            // si oui
            // Vérifier si on a déjà un todd avec le meme name
            $todos = $session->get('todos');
            if (!isset($todos[$name])) {
                // si oui afficher errerur
                $this->addFlash('error', "Le todo d'id $name n'existe pas dans la liste");
            } else {
                // si non on l'ajouter et on affiche un message de succès
                unset($todos[$name]);
                $session->set('todos', $todos);
                $this->addFlash('success', "Le todo d'id $name a été supprimé avec succès");
            }
        } else {
            // si non
            // afficher une erreur et on va redirger vers le controlleur index
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");
        }
        return $this->redirectToRoute('todo');
    }
    #[Route('/reset', name: 'todo.reset')]
    public function resetTodo( SessionInterface $session): RedirectResponse {
        $session->remove('todos');
        return $this->redirectToRoute('todo');
    }
}
