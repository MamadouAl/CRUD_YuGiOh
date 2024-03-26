<?php

namespace App\Controller;

use App\Entity\CarteEdition;
use App\Entity\CartePossedee;
use App\Entity\Edition;
use App\Entity\Langue;
use App\Form\EditionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EditionController extends AbstractController
{

    #[Route('/editions', name: 'editions')]
    public function index(EntityManagerInterface $em): Response
    {
        $editions = $em->getRepository(Edition::class)->findAll();
        return $this->render('edition/index.html.twig', [
            'controller_name' => 'EditionController',
            'editions' => $editions,
        ]);
       
    }

    #[Route('/edition/{id}', name: 'edition_carte')]
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

//    #[Route('/editions/insert', name: 'insert_edition')]
//    public function insert0(EntityManagerInterface $em): Response
//    {
//        $edition = new Edition();
//        $edition->setNomEdition('Nouvelle Edition 2024');
//        $edition->setDateEdition(new \DateTime('2021-12-01'));
//        $em->persist($edition);
//        $em->flush();
//        return $this->redirectToRoute('editions');
//    }

    #[Route('/editions/insert', name: 'insert_edition')]
    public function insert(Request $request, EntityManagerInterface $em): Response
    {
        $edition = new Edition();
        $form = $this->createForm(EditionType::class, $edition);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $edition = $form->getData();
            $em->persist($edition);
            $em->flush();
            return $this->redirectToRoute('editions');
        }

        // Si le formulaire n'est pas encore soumis ou s'il n'est pas valide,
        return $this->render('edition/insert.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edition/update/{id}', name: 'update_edition')]
    public function update(Request $request, EntityManagerInterface $em, $id): Response
    {
        $edition = $em->getRepository(Edition::class)->find($id);
        if (!$edition) {
            throw $this->createNotFoundException('L\'édition avec l\'ID '.$id.' n\'existe pas.');
        }
        $form = $this->createForm(EditionType::class, $edition);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($form->get('save')->isClicked()) {
                $em->persist($edition);
                $em->flush();
                return $this->redirectToRoute('editions');
            }

        }

        return $this->render('edition/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edition/delete/{id}', name: 'delete_edition')]
    public function delete($id, EntityManagerInterface $em): Response
    {
        $carteEdition = $em->getRepository(CarteEdition::class)->findBy(['edition' => $id]); 
        foreach ($carteEdition as $carteEdition) {
            $em->remove($carteEdition);
        }

        //pareil dans la table cartePossedee
        $cartePossedee = $em->getRepository(CartePossedee::class)->findBy(['edition' => $id]);
        foreach ($cartePossedee as $cartePossedee) {
            $em->remove($cartePossedee);
        }
        $edition = $em->getRepository(Edition::class)->find($id);
        $em->remove($edition);
        $em->flush();
        return $this->redirectToRoute('editions');
    }

//    #[Route('/edition/update/{id}', name: 'update_edition')]
//    public function update($id, EntityManagerInterface $em): Response
//    {
//        $edition = $em->getRepository(Edition::class)->find($id);
//        $edition->setNomEdition('Batailles de Légende : La Vengeance Monstrueuse');
//        $em->persist($edition);
//        $em->flush();
//        return $this->redirectToRoute('editions');
//    }
}
