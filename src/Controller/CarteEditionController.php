<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Entity\CarteEdition;
use App\Entity\Edition;
use App\Entity\Langue;
use App\Form\CarteEditionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteEditionController extends AbstractController
{
   
    #[Route('/carte_edition/insert', name: 'carte_edition_insert')]
    public function insert(Request $request, EntityManagerInterface $entityManager): Response
    {
        $carteEdition = new CarteEdition();
        $form = $this->createForm(CarteEditionType::class, $carteEdition);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($carteEdition);
            $entityManager->flush();

            $this->addFlash('success', 'CarteEdition ajoutée avec succès !');

            return $this->redirectToRoute('editions'); // Redirige où vous le souhaitez
        }
        return $this->render('carte_edition/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    //update
    #[Route('/carteEdition/update/{carte_id}/{edition_id}', name: 'update_carteEdition')]
    public function update(int $carte_id, int $edition_id, Request $request, EntityManagerInterface $em): Response
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

        $form = $this->createForm(CarteEditionType::class, $carteEdition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('edition_carte', ['id' => $edition_id]);
        }

        return $this->render('carte_edition/update.html.twig', [
            'form' => $form->createView(),
        ]);
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
