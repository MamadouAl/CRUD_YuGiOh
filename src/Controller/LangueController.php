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
}
