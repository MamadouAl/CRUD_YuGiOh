<?php

namespace App\Controller;

use App\Entity\Edition;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EditionController extends AbstractController
{
    #[Route('/edition', name: 'editions')]
    public function index(EntityManagerInterface $em): Response
    {
        $editions = $em->getRepository(Edition::class)->findAll();
        return $this->render('edition/index.html.twig', [
            'controller_name' => 'EditionController',
            'editions' => $editions,
        ]);
       
    }

    #[Route('/edition/insert', name: 'insert_edition')]
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
