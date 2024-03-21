<?php

namespace App\Controller;

use App\Entity\Edition;
use App\Entity\Langue;
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
        $cartes = $edition->getCarteEditions();
        $langues = $em->getRepository(Langue::class)->findAll();
      
        return $this->render('carte_edition/index.html.twig', [
            'edition' => $edition,
            'cartes' => $cartes,
            'langues' => $langues,
        ]);
    }
}
