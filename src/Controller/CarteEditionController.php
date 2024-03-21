<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Entity\CarteEdition;
use App\Entity\Edition;
use App\Entity\Langue;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteEditionController extends AbstractController
{
   
    //insert
    #[Route('/carteEdition/insert', name: 'insert_carteEdition')]
    public function insert(EntityManagerInterface $em): Response
    {
       $carte = $em -> getRepository(Carte::class)->find(500);
       $edition = $em -> getRepository(Edition::class)->find(476);

         if(!$carte || !$edition){
              throw $this->createNotFoundException('Pas de carte ou d\'édition trouvée pour l\'id donné');
         }
            $carteEdition = new CarteEdition();
            $carteEdition->setCarte($carte);
            $carteEdition->setEdition($edition);
            $carteEdition->setRarete('Rare');

            $em->persist($carteEdition);
            $em->flush();
            return $this->redirectToRoute('editions');
    }

    //update
    #[Route('/carteEdition/update/{carte_id}/{edition_id}', name: 'update_carteEdition')]
    public function update(int $carte_id, int $edition_id, EntityManagerInterface $em): Response
    {
        //recuperer la carte possedee et fonctions des id de la carte, de l'edition et de la langue
        $carteEdition = $em->getRepository(CarteEdition::class)->findOneBy([
            'carte' => $carte_id,
            'edition' => $edition_id,
        ]);

        //si la carte possedee n'existe pas
        if (!$carteEdition) {
            throw $this->createNotFoundException('Pas de carte possedee trouvée pour l\'id donné');
        }
        $carteEdition->setRarete('Rare');
        $em->persist($carteEdition);
        $em->flush();
        return $this->redirectToRoute('edition_carte', ['id' => $edition_id]);
    }

    //delete
    #[Route('/carteEdition/delete/{carte_id}/{edition_id}', name: 'delete_carteEdition')]
    public function delete(int $carte_id, int $edition_id, EntityManagerInterface $em): Response
    {
        //recuperer la carte possedee et fonctions des id de la carte, de l'edition et de la langue
        $carteEdition = $em->getRepository(CarteEdition::class)->findOneBy([
            'carte' => $carte_id,
            'edition' => $edition_id,
        ]);

        //si la carte possedee n'existe pas
        if (!$carteEdition) {
            throw $this->createNotFoundException('Pas de carte possedee trouvée pour l\'id donné');
        }
        $em->remove($carteEdition);
        $em->flush();
        return $this->redirectToRoute('edition_carte', ['id' => $edition_id]);
    }
   
}
