<?php

namespace App\Controller;

use App\Entity\RendezVous;
use App\Repository\RendezVousRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecretaireController extends AbstractController
{
    #[Route('/secretaire/dashboard', name: 'secretaire_dashboard')]
    public function dashboard(RendezVousRepository $repo): Response
    {
        $rendezVous = $repo->findBy([], ['date' => 'DESC']);

        return $this->render('secretaire/dashboard.html.twig', [
            'rendezVous' => $rendezVous
        ]);
    }

    #[Route('/secretaire/rendezvous/{id}/accept', name: 'secretaire_rdv_accept')]
    public function accept(RendezVous $rendezVous, EntityManagerInterface $em): Response
    {
        $rendezVous->setStatus('valide');
        $em->flush();

        return $this->redirectToRoute('secretaire_dashboard');
    }

    #[Route('/secretaire/rendezvous/{id}/refuse', name: 'secretaire_rdv_refuse')]
    public function refuse(RendezVous $rendezVous, EntityManagerInterface $em): Response
    {
        $rendezVous->setStatus('annule');
        $em->flush();

        return $this->redirectToRoute('secretaire_dashboard');
    }

    // ⭐ AJOUT : PAGE PATIENTS
    #[Route('/secretaire/patients', name: 'secretaire_patients')]
    public function patients(UserRepository $userRepo): Response
    {
        $patients = $userRepo->findPatients();

        return $this->render('secretaire/patients.html.twig', [
            'patients' => $patients
        ]);
    }
}
