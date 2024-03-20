<?php

namespace App\Controller;

use App\Entity\Carte;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

     #[Route('/cartes/{id}', name: 'detail_carte')]
    public function show($id, EntityManagerInterface $em): Response
    {
        $carte = $em->getRepository(Carte::class)->find($id);
        if (!$carte) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $this->render('carte/show.html.twig', [
            'carte' => $carte,
        ]);
    }
}
