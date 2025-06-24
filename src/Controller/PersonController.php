<?php

namespace App\Controller;

use App\Entity\Dossier;
use App\Entity\Person;
use App\Repository\DossierRepository;
use App\Repository\PersonRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('person')]
final class PersonController extends AbstractController
{
    protected  PersonRepository $personRepository;
    public function __construct(protected ManagerRegistry $doctrine)
    {
        $this->personRepository = $this->doctrine->getRepository(Person::class);
        $this->manager = $this->doctrine->getManager();
    }
    #[Route('/{page?1}/{nbre?10}', name: 'app_person')]
    public function index($page, $nbre): Response
    {
        $nbPersonne = $this->personRepository->count([]);
        $nbrePage = ceil($nbPersonne / $nbre) ;
        $personnes = $this->personRepository->findBy([], [],$nbre, ($page - 1 ) * $nbre);

        return $this->render('person/index.html.twig', [
            'persons' => $personnes,
            'isPaginated' => true,
            'nbrePage' => $nbrePage,
            'page' => $page,
            'nbre' => $nbre
        ]);
    }
    #[Route('/detail/{id}', name: 'app_detail_person')]
    public function detail(Person $person = null): Response
    {
        if (!$person)
            throw new NotFoundHttpException('Person not found');

        return $this->render('person/detail.html.twig', [
            'person' => $person,
        ]);
    }

    #[Route('/add/{name}/{firstname}/{age}/{cin}/{path?}', name: 'app_add_person')]
    public function add($name, $firstname, $age, $cin, $path): Response
    {
        $person = new Person();
        $person->setAge($age)
               ->setName($name)
               ->setName($firstname)
               ->setCin($cin)
               ->setPath($path);
        $this->manager->persist($person);
        $this->manager->flush();
        return $this->redirectToRoute('app_person');
    }

    #[Route('/update/{id}/{name}/{firstname}/{age}/{cin}', name: 'app_update_person')]
    public function update($id,$name, $firstname, $age, $cin, $path): Response
    {
        $person = $this->personRepository->find($id);
        if (!$person)
            throw new NotFoundHttpException('Person not found');

        $person->setAge($age)
            ->setName($name)
            ->setName($firstname)
            ->setCin($cin)
            ->setPath($path);
        $this->manager->persist($person);
        $this->manager->flush();
        return $this->redirectToRoute('app_person');
    }
    #[Route('/delete/{id}', name: 'delete_person')]
    public function delete($id): Response
    {
        $person = $this->personRepository->find($id);
        if (!$person)
            throw new NotFoundHttpException('Person not found');
        $this->manager->remove($person);
        $this->manager->flush();
        return $this->redirectToRoute('app_person');
    }
}
