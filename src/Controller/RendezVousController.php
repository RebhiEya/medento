<?php

namespace App\Controller;

use App\Entity\RendezVous;
use App\Form\RendezVousType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RendezVousController extends AbstractController
{
    #[Route('/patient/rendezvous/new', name: 'patient_rendezvous_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rendezVous = new RendezVous();
        $rendezVous->setUser($this->getUser());

        $form = $this->createForm(RendezVousType::class, $rendezVous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rendezVous);
            $entityManager->flush();

            // ✅ REDIRECTION CORRECTE
            return $this->redirectToRoute('patient_dashboard');
        }

        return $this->render('rendez_vous/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
