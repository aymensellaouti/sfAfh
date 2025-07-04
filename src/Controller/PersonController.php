<?php

namespace App\Controller;


use App\Entity\Person;
use App\Form\PersonForm;
use App\Repository\PersonRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('person')]
final class PersonController extends AbstractController
{
    protected  PersonRepository $personRepository;
    public function __construct(
        protected ManagerRegistry $doctrine,
        private SluggerInterface $slugger,
    )
    {
        $this->personRepository = $this->doctrine->getRepository(Person::class);
        $this->manager = $this->doctrine->getManager();
    }

    #[Route('/edit/{id?0}', name: 'person.edit')]
    public function edit(Request $request, Person $person = null): Response
    {
        if(!$person)
            $person = new Person();
        $form = $this->createForm(PersonForm::class, $person,
//            [
//            'action' => $this->generateUrl('person_add'),
//        ]
        );
//        $form->remove('dossier');
        $form->handleRequest($request);
        // Itha el formulaire soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {

            // Bech ngéri l'upload
            $file = $form->get('file')->getData();
            if ($file) {
                // Njib el path
                $folder = $this->getParameter('person_directory');
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $this->slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $folder,
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $person->setPath($newFilename);
            }

            // Bech nzid fel database
            $this->manager->persist($person);
            $this->manager->flush();
            // bech nhezou lel liste des personnes
            return $this->redirectToRoute('app_person');
        }
        // else : ya ema mech soumis wa ella mech valide

        // Bech n'affichi el form
        return $this->render('person/add_person.html.twig', [
            'form' => $form->createView(),
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
}
