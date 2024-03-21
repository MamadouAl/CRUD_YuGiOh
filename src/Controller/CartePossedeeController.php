<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Entity\CartePossedee;
use App\Entity\Edition;
use App\Entity\Langue;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartePossedeeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('collection/index.html.twig', [
            'controller_name' => 'CartePossedeeController',
        ]);
    }

    #[Route('/insert/{carteId}/{editionId}/{langueId}', name: 'insert_collection')]
    public function insert(int $carteId, int $editionId, int $langueId, EntityManagerInterface $em): Response
    {
        $carte = $em->getRepository(Carte::class)->find($carteId);
        $edition = $em->getRepository(Edition::class)->find($editionId);
        $langue = $em->getRepository(Langue::class)->find($langueId);

        if (!$carte || !$edition || !$langue) {
            throw $this->createNotFoundException('No card, edition or language found for given id');
        }

        $collection = new CartePossedee();
        $collection->setCarte($carte);
        $collection->setEdition($edition);
        $collection->setLangue($langue);
        $collection->setQuantite(1);

        $em->persist($collection);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    //update
    #[Route('/update/{carteId}/{editionId}/{langueId}', name: 'update_collection')]
    public function update(int $carteId, int $editionId, int $langueId, EntityManagerInterface $em): Response
    {
        $carte = $em->getRepository(Carte::class)->find($carteId);
        $edition = $em->getRepository(Edition::class)->find($editionId);
        $langue = $em->getRepository(Langue::class)->find($langueId);

        //...

        return $this->redirectToRoute('home');
    }


}
