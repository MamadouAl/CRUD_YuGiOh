<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Entity\CartePossedee;
use App\Entity\Edition;
use App\Entity\Langue;
use App\Form\CartePossedeeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartePossedeeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EntityManagerInterface $em): Response
    {

        $cartes = $em->getRepository(CartePossedee::class)->findAll();
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

#[Route('/insert', name: 'add_to_collection', methods: ['POST'])]
public function addToCollection(Request $request, EntityManagerInterface $entityManager): Response
{
    $langueId = $request->request->get('langue');
    $carteId = $request->request->get('carte_id');
    $editionId = $request->request->get('edition_id');
   
    $langue = $entityManager->getRepository(Langue::class)->find($langueId);
    $carte = $entityManager->getRepository(Carte::class)->find($carteId);
    $edition = $entityManager->getRepository(Edition::class)->find($editionId);
   
    $carteEdition = new CartePossedee();
    $carteEdition->setLangue($langue);
    $carteEdition->setCarte($carte);
    $carteEdition->setEdition($edition);
    $carteEdition->setQuantite(1);
    
    // Enregistrer la nouvelle carte édition dans la base de données
    $entityManager->persist($carteEdition);
    $entityManager->flush();
    
    // Rediriger l'utilisateur vers une page de confirmation ou autre
    return $this->redirectToRoute('home');
}

   
    // #[Route('/update/{carte_id}/{edition_id}/{langue_id}', name: 'update_collection')]
    // public function update($carte_id,$edition_id,$langue_id, EntityManagerInterface $em): Response
    // {
    //     //recuperer la carte possedee et fonctions des id de la carte, de l'edition et de la langue
    //     $cartePossedee = $em->getRepository(CartePossedee::class)->findOneBy([
    //         'carte' => $carte_id,
    //         'edition' => $edition_id,
    //         'langue' => $langue_id,
    //     ]);

    //     //si la carte possedee n'existe pas
    //     if (!$cartePossedee) {
    //         throw $this->createNotFoundException('Pas de carte possedee trouvée pour lid donné');
    //     }
    //     //modifier la quantite
    //     $cartePossedee->setQuantite(10);
    //     $em->persist($cartePossedee);
    //     $em->flush();
    //     return $this->redirectToRoute('home');
    // }
     #[Route('/update/{carte_id}/{edition_id}/{langue_id}', name: 'carte_possedee_update')]
public function update(int $carte_id, int $edition_id, int $langue_id,Request $request, EntityManagerInterface $entityManager): Response
{
    $cartePossedee = $entityManager->getRepository(CartePossedee::class)->findOneBy([
        'carte' => $carte_id,
        'edition' => $edition_id,
        'langue' => $langue_id,
    ]);

    if (!$cartePossedee) {
        throw $this->createNotFoundException('Pas de carte possedee trouvée pour l\'id donné');
    }

    $form = $this->createForm(CartePossedeeType::class, $cartePossedee);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // dd($cartePossedee);
        $entityManager->flush();
        return $this->redirectToRoute('home');
    }

    return $this->render('collection/update.html.twig', [
        'form' => $form->createView(),
    ]);
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
