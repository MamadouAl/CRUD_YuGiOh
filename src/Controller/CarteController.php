<?php

namespace App\Controller;
use App\Entity\Carte;
use App\Entity\Edition;

use App\Form\CarteType;
use App\Form\EditionType;
use App\Repository\CarteEditionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarteController extends AbstractController
{
    #[Route('/cartes', name: 'cartes')]
    public function index(EntityManagerInterface $em): Response
    {
        $cartes = $em->getRepository(Carte::class)->findAll();
        
        return $this->render('carte/index.html.twig', [
            'controller_name' => 'CarteController',
            'cartes' => $cartes,
        ]);
    }

//     #[Route('/carte/insert', name: 'insert_carte')]
//    public function insert(EntityManagerInterface $em): Response
//{
//    $carte = new Carte();
//
//    $carte->setCarteNom('NOuvelle carte carte');
//    $carte->setCarteCategorie('Catégorie de la carte');
//    $carte->setCarteAttribut('Attribut de la carte');
//    $carte->setCarteImage('Image de la carte');
//    $carte->setCarteType('Type de la carte');
//    $carte->setCarteNiveau(5); // Par exemple, niveau 5
//    $carte->setCarteSpecificite('Spécificité de la carte');
//    $carte->setCarteATK(2000); // Par exemple, 2000 points d'attaque
//    $carte->setCarteDEF(1500); // Par exemple, 1500 points de défense
//    $carte->setCarteDescription('Description de la carte');
//    // dd($carte);
//    $em->persist($carte);
//    $em->flush();
//
//    return $this->redirectToRoute('cartes');
//
//}

    #[Route('/carte/insert', name: 'insert_carte')]
    public function insert(Request $request, EntityManagerInterface $em): Response
    {
        $carte = new Carte();
        $form = $this->createForm(CarteType::class, $carte);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($carte);
            $em->flush();
            return $this->redirectToRoute('cartes');
        }
        return $this->render('carte/insert.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/carte/update/{id}', name: 'update_carte')]
    public function update($id, EntityManagerInterface $em, Request $request): Response
    {
        $carte = $em->getRepository(Carte::class)->find($id);
        $form = $this->createForm(CarteType::class, $carte);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('cartes');
        }
        return $this->render('carte/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/carte/{id}', name: 'detail_carte')]
    public function show($id, EntityManagerInterface $em, CarteEditionRepository $carteEditionRepository): Response
    {
        $carte = $em->getRepository(Carte::class)->find($id);
        
        $idEdition = $carte  -> getEditionId($em, $carteEditionRepository);
        if($idEdition) {
            $edition = $em->getRepository(Edition::class)->find($idEdition)->getNomEdition();
        }else {
            $edition = "Pas d'édition renseignée";
        }

       // dd($edition->getNomEdition());

        if (!$carte) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
       
        return $this->render('carte/show.html.twig', [
            'carte' => $carte,
            'edition' => $edition,
        ]);
    }

    // je veux la methode supprimer une carte en prenant l'id en parametre
    #[Route('/carte/delete/{id}', name: 'delete_carte')]
    public function delete($id, EntityManagerInterface $em): Response
    {
        // dd($id);
        $carte = $em->getRepository(Carte::class)->find($id);
        $em->remove($carte);
        $em->flush();
        return $this->redirectToRoute('cartes');
    }
}
