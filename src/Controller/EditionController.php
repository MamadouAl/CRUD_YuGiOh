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
}
