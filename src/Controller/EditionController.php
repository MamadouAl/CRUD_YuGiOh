<?php

namespace App\Controller;

use App\Entity\Edition;
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
    #[Route('/editions/{id}', name: 'detail_edition')]
    public function show($id, EntityManagerInterface $em): Response
    {
        $edition = $em->getRepository(Edition::class)->find($id);
        if (!$edition) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $this->render('edition/show.html.twig', [
            'edition' => $edition,
        ]);
    }
    #[Route('/editions/delete/{id}', name: 'delete_edition')]
    public function delete($id, EntityManagerInterface $em): Response
    {
        // dd($id);
        $edition = $em->getRepository(Edition::class)->find($id);
        $em->remove($edition);
        $em->flush();
        return $this->redirectToRoute('editions');
    }
    // #[Route('/editions/insert', name: 'insert_edition')]
    // public function insert(EntityManagerInterface $em): Response
    // {
    //     $edition = new Edition();
    //     $edition->setNomEdition('Edition 1');
    //     $em->persist($edition);
    //     $em->flush();
    //     return $this->redirectToRoute('editions');
    // }
    //redifini la methode insert avec des valeur donner statiquement
    #[Route('/editions/insert', name: 'insert_edition')]
    public function insert(EntityManagerInterface $em): Response
    {
        $edition = new Edition();
        $edition->setNomEdition('Nouvelle Edition');
        $edition->setDateEdition(new \DateTime('2021-10-10'));
        $em->persist($edition);
        $em->flush();
        return $this->redirectToRoute('editions');
    }


    #[Route('/editions/update/{id}', name: 'update_edition')]
    public function update($id, EntityManagerInterface $em): Response
    {
        $edition = $em->getRepository(Edition::class)->find($id);
        $edition->setNomEdition('Edition 2');
        $em->persist($edition);
        $em->flush();
        return $this->redirectToRoute('editions');
    }

}
