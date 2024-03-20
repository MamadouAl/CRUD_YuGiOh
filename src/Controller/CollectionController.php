<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CollectionController extends AbstractController
{
    #[Route('/home/{carteId}/{editionId}', name: 'home')]
    public function index(int $carteId, int $editionId): Response
    {
        // Vous pouvez maintenant utiliser $carteId et $editionId
        return $this->render('collection/index.html.twig', [
            'controller_name' => 'CollectionController',
            'carteId' => $carteId,
            'editionId' => $editionId,
        ]);
    }
}
