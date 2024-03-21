<?php

namespace App\Controller;

use App\Entity\Edition;
use App\Entity\Langue;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/editions/insert', name: 'insert_edition')]
    public function insert(EntityManagerInterface $em): Response
    {
        $edition = new Edition();
        $edition->setNomEdition('Nouvelle Edition 24');
        $edition->setDateEdition(new \DateTime('2021-12-01'));
        $em->persist($edition);
        $em->flush();
        return $this->redirectToRoute('editions');
    }

    #[Route('/edition/delete/{id}', name: 'delete_edition')]
    public function delete($id, EntityManagerInterface $em): Response
    {
        // dd($id);
        $edition = $em->getRepository(Edition::class)->find($id);
        $em->remove($edition);
        $em->flush();
        return $this->redirectToRoute('editions');
    }

    #[Route('/edition/update/{id}', name: 'update_edition')]
    public function update($id, EntityManagerInterface $em): Response
    {
        $edition = $em->getRepository(Edition::class)->find($id);
        $edition->setNomEdition('Batailles de Légende : La Vengeance Monstrueuse');
        $em->persist($edition);
        $em->flush();
        return $this->redirectToRoute('editions');
    }
}
