<?php

namespace App\Controller;

use App\Entity\Edition;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteEditionController extends AbstractController
{
    #[Route('/editions/{id}', name: 'edition_carte')]
    public function showEditionDetail($id, EntityManagerInterface $em): Response
    {

        $edition = $em->getRepository(Edition::class)->find($id);
        
        // Vérifier si l'édition existe
        if (!$edition) {
            throw $this->createNotFoundException('L\'édition avec l\'ID '.$id.' n\'existe pas.');
        }
        //je veux recuperer les cartes de cette etudiion dans la carte_edition vu qu'on a l'id d'une edition
        // Récupérer les cartes de cette édition
        $cartes = $edition->getCarteEditions();
        // dd($cartes[0]->getCarte()->getCarteNom());
        // Vous pouvez retourner les cartes dans un template Twig
        return $this->render('carte_edition/index.html.twig', [
            'edition' => $edition,
            'cartes' => $cartes,
        ]);
    }
}
