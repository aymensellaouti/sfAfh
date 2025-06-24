<?php

namespace App\Controller;

use App\Entity\Dossier;
use App\Repository\DossierRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dossier')]
final class DossierController extends AbstractController
{
    /**
     * @var ObjectManager
     * Lahilna bel persistnace
     */
    protected  ObjectManager $manager;
    /**
     * @var DossierRepository|\Doctrine\Persistence\ObjectRepository
     * Lahi bel consultation
     */
    protected  DossierRepository $dossierRepository;
    public function __construct(protected ManagerRegistry $doctrine)
    {
        $this->dossierRepository = $this->doctrine->getRepository(Dossier::class);
        $this->manager = $this->doctrine->getManager();
    }

    #[Route('/', name: 'app_dossier')]
    public function index(): Response
    {
        $dossiers = $this->dossierRepository->findAll();
        return $this->render('dossier/index.html.twig', [
            'dossiers' => $dossiers,
        ]);
    }
    #[Route('/add', name: 'app_add_dossier')]
    public function add(): Response
    {
        $dossier = new Dossier();
        $dossier->setRefrence('2025AS0082SF')
                ->setStatus('C')
                ->setCreationDate(new \DateTime());
//        $dossier2 = new Dossier();
//        $dossier2->setRefrence('2025AS0082SS')
//                ->setStatus('B')
//                ->setCreationDate(new \DateTime());
        $this->manager->persist($dossier);
//        $this->manager->persist($dossier2);
        $this->manager->flush();
        return $this->render('dossier/index.html.twig', [
            'dossiers' => [$dossier],
        ]);
    }
}
