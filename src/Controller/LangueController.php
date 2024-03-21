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
    #[Route('/langues/{id}', name: 'detail_langue')]
    public function show($id, EntityManagerInterface $em): Response
    {
        $langue = $em->getRepository(Langue::class)->find($id);
        if (!$langue) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $this->render('langue/show.html.twig', [
            'langue' => $langue,
        ]);
    }
    #[Route('/langues/delete/{id}', name: 'delete_langue')]
    public function delete($id, EntityManagerInterface $em): Response
    {
        $langue = $em->getRepository(Langue::class)->find($id);
        $em->remove($langue);
        $em->flush();
        return $this->redirectToRoute('langues');
    }
    #[Route('/langues/insert', name: 'insert_langue')]
    public function insert(EntityManagerInterface $em): Response
    {
        $langue = new Langue();
        $langue->setNomLangue('Français');
        $em->persist($langue);
        $em->flush();
        return $this->redirectToRoute('langues');
    }
    #[Route('/langues/update/{id}', name: 'update_langue')]
    public function update($id, EntityManagerInterface $em): Response
    {
        $langue = $em->getRepository(Langue::class)->find($id);
        $langue->setNomLangue('Anglais');
        $em->persist($langue);
        $em->flush();
        return $this->redirectToRoute('langues');
    }
    
}
