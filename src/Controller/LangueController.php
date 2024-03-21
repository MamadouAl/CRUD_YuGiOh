<?php

namespace App\Controller;

use App\Entity\Langue;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LangueController extends AbstractController
{
    #[Route('/langues', name: 'langues')]
    public function index(EntityManagerInterface $em): Response
    {
        $langues=$em->getRepository(Langue::class)->findAll();
        return $this->render('langue/index.html.twig', [
            'controller_name' => 'LangueController',
            'langues' => $langues,
        ]);
    }

    #[Route('/langues/insert', name: 'insert_langue')]
    public function insert(EntityManagerInterface $em): Response
    {
        $langue = new Langue();
        $langue->setNomLangue('Blabla');
        $em->persist($langue);
        $em->flush();
        return $this->redirectToRoute('langues');
    }

    #[Route('/langues/{id}', name: 'detail_langue')]
    public function show($id, EntityManagerInterface $em): Response
    {
        $langue = $em->getRepository(Langue::class)->find($id);
        if (!$langue) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return dd($langue->getNomLangue());

    }
    #[Route('/langue/delete/{id}', name: 'delete_langue')]
    public function delete($id, EntityManagerInterface $em): Response
    {
        $langue = $em->getRepository(Langue::class)->find($id);
        $em->remove($langue);
        $em->flush();
        return $this->redirectToRoute('langues');
    }


    #[Route('/langue/update/{id}', name: 'update_langue')]
    public function update($id, EntityManagerInterface $em): Response
    {
        $langue = $em->getRepository(Langue::class)->find($id);
        $langue->setNomLangue('Poular');
        $em->persist($langue);
        $em->flush();
        return $this->redirectToRoute('langues');
    }
    
}
