<?php

namespace App\Controller;

use App\Entity\Langue;
use App\Form\LangueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/langues/insert', name: 'langue_insert', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $langue = new Langue();
        $form = $this->createForm(LangueType::class, $langue);

        $form->handleRequest($request);
        // dd($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($langue);
            $entityManager->flush();

            return $this->redirectToRoute('langues');
        }

        return $this->render('langue/add.html.twig', [
            'langue' => $langue,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/langue/{id}', name: 'detail_langue')]
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
    public function update(Request $request, EntityManagerInterface $entityManager, Langue $langue): Response
    {
        $form = $this->createForm(LangueType::class, $langue);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            $this->addFlash('success', 'Langue mise à jour avec succès !');
    
            return $this->redirectToRoute('langues');
        }
    
        return $this->render('langue/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    //methode edit
    #[Route('/langue/edit/{id}', name: 'edit_langue')]
    public function edit(Langue $langue)
    {
        $form=$this->createForm(LangueType::class, $langue);
        return $this->render('langue/edit.html.twig', [
            'langue' => $langue,
            'form' => $form,
        ]);
    }
}
