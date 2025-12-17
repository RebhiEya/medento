<?php

namespace App\Controller;

use App\Repository\RendezVousRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientController extends AbstractController
{
    #[Route('/patient/dashboard', name: 'patient_dashboard')]
    public function dashboard(RendezVousRepository $rendezVousRepository): Response
    {
        $rendezVous = $rendezVousRepository->findBy(
            ['user' => $this->getUser()],
            ['date' => 'DESC']
        );

        return $this->render('patient/dashboard.html.twig', [
            'rendezVous' => $rendezVous
        ]);
    }

    #[Route('/patient/services', name: 'patient_services')]
    public function services(ServiceRepository $serviceRepository): Response
    {
        $services = $serviceRepository->findAll();

        return $this->render('patient/service.html.twig', [
            'services' => $services
        ]);
    }
}
