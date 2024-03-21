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

    #[Route('/insert/', name: 'insert_collection')]
    public function insert(EntityManagerInterface $em): Response
    {
        $carte = $em->getRepository(Carte::class)->find(500);
        $edition = $em->getRepository(Edition::class)->find(1);
        $langue = $em->getRepository(Langue::class)->find(2);

        if (!$carte || !$edition || !$langue) {
            throw $this->createNotFoundException('Pas de carte, d\'édition ou de langue trouvée pour l\'id donné');
        }

        $collection = new CartePossedee();
        $collection->setCarte($carte);
        $collection->setEdition($edition);
        $collection->setLangue($langue);
        $collection->setQuantite(10);

        $em->persist($collection);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    //update
    #[Route('/update/{carte_id}/{edition_id}/{langue_id}', name: 'update_collection')]
    public function update(int $carte_id, int $edition_id, int $langue_id, EntityManagerInterface $em): Response
    {
        //recuperer la carte possedee et fonctions des id de la carte, de l'edition et de la langue
        $cartePossedee = $em->getRepository(CartePossedee::class)->findOneBy([
            'carte' => $carte_id,
            'edition' => $edition_id,
            'langue' => $langue_id
        ]);

        //si la carte possedee n'existe pas
        if (!$cartePossedee) {
            throw $this->createNotFoundException('Pas de carte possedee trouvée pour l\'id donné');
        }
        //modifier la quantite
        $cartePossedee->setQuantite(20);
        $em->persist($cartePossedee);
        $em->flush();
        return $this->redirectToRoute('home');
    }

    //delete
    #[Route('/delete/{carte_id}/{edition_id}/{langue_id}', name: 'delete_collection')]
    public function delete(int $carte_id, int $edition_id, int $langue_id, EntityManagerInterface $em): Response
    {
        //recuperer la carte possedee et fonctions des id de la carte, de l'edition et de la langue
        $cartePossedee = $em->getRepository(CartePossedee::class)->findOneBy([
            'carte' => 500,
            'edition' => 1,
            'langue' => 2
        ]);

        //si la carte possedee n'existe pas
        $cartePossedee = $em->getRepository(CartePossedee::class)->findOneBy([
            'carte' => $carte_id,
            'edition' => $edition_id,
            'langue' => $langue_id
        ]);
        //supprimer la carte possedee
        $em->remove($cartePossedee);
        $em->flush();
        return $this->redirectToRoute('home');
    }
}
