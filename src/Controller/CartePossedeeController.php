<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Entity\CartePossedee;
use App\Entity\Edition;
use App\Entity\Langue;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartePossedeeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EntityManagerInterface $em): Response
    {

        $cartes = $em->getRepository(CartePossedee::class)->findAll();
        //faie une boucle sur les carte et stocke dans 3 variables le nombre carte de categorie magie monstre et piege
        $nbCarteMagie = 0;
        $nbCarteMonstre = 0;
        $nbCartePiege = 0;
        foreach ($cartes as $carte) {
            if ($carte->getCarte()->getCarteCategorie() == 'Magie') {
                $nbCarteMagie++;
            } elseif ($carte->getCarte()->getCarteCategorie() == 'Monstre') {
                $nbCarteMonstre++;
            } elseif ($carte->getCarte()->getCarteCategorie() == 'Piège') {
                $nbCartePiege++;
            }
        }

        return $this->render('collection/index.html.twig', [
            'controller_name' => 'CartePossedeeController',
            'cartes' => $cartes,
            'nbCarteMagie' => $nbCarteMagie,
            'nbCarteMonstre' => $nbCarteMonstre,
            'nbCartePiege' => $nbCartePiege,
        ]);
    }
    #[Route('/insert', name: 'insert_carte_possedee')]
    public function insert(EntityManagerInterface $em): Response
    {
        // Création d'une nouvelle instance de CartePossedee
        $cartePossedee = new CartePossedee();

        // Récupération d'une carte, d'une édition et d'une langue de la base de données
        $carte = $em->getRepository(Carte::class)->find(4);
        $edition = $em->getRepository(Edition::class)->find(1);
        $langue = $em->getRepository(Langue::class)->find(1);

        // Définition des valeurs pour l'entité CartePossedee
        $cartePossedee->setCarte($carte);
        $cartePossedee->setEdition($edition);
        $cartePossedee->setLangue($langue);
        $cartePossedee->setQuantite(1);

        // Persiste l'entité dans la base de données
        $em->persist($cartePossedee);
        $em->flush();

        // Redirige vers la page d'accueil après l'insertion
        return $this->redirectToRoute('home');
    }
   
    #[Route('/update/{carte_id}/{edition_id}/{langue_id}', name: 'update_collection')]
    public function update($carte_id,$edition_id,$langue_id, EntityManagerInterface $em): Response
    {
        //recuperer la carte possedee et fonctions des id de la carte, de l'edition et de la langue
        $cartePossedee = $em->getRepository(CartePossedee::class)->findOneBy([
            'carte' => $carte_id,
            'edition' => $edition_id,
            'langue' => $langue_id,
        ]);

        //si la carte possedee n'existe pas
        if (!$cartePossedee) {
            throw $this->createNotFoundException('Pas de carte possedee trouvée pour lid donné');
        }
        //modifier la quantite
        $cartePossedee->setQuantite(10);
        $em->persist($cartePossedee);
        $em->flush();
        return $this->redirectToRoute('home');
    }

    //delete
    #[Route('/delete/{carte_id}/{edition_id}/{langue_id}', name: 'delete_collection')]
    public function delete($carte_id,$edition_id,$langue_id,EntityManagerInterface $em): Response
    {
        //recuperer la carte possedee et fonctions des id de la carte, de l'edition et de la langue
        $cartePossedee = $em->getRepository(CartePossedee::class)->findOneBy([
            'carte' => $carte_id,
            'edition' => $edition_id,
            'langue' => $langue_id,
        ]);

        //si la carte possedee n'existe pas
        if (!$cartePossedee) {
            throw $this->createNotFoundException('Pas de carte possedee trouvée pour lid donné');
        }
        //supprimer la carte possedee
        $em->remove($cartePossedee);
        $em->flush();
        return $this->redirectToRoute('home');
    }
}
