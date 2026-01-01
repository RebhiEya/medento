<?php

namespace App\Controller;

use App\Repository\RendezVousRepository;
use App\Repository\ServiceRepository;   // 🔥 AJOUT
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DentisteController extends AbstractController
{
    #[Route('/dentiste/dashboard', name: 'dentiste_dashboard')]
    public function dashboard(RendezVousRepository $repo, ServiceRepository $serviceRepo): Response
    {
        // 🔵 Statistiques Rendez-vous (déjà existant)
        $stats = $repo->countRendezVousByDay();

        $labels = [];
        $data = [];

        foreach ($stats as $row) {
            $labels[] = $row['day'];
            $data[] = $row['total'];
        }

        // 🟢 Statistiques Services (NOUVEAU)
        $services = $serviceRepo->findAll();

        $serviceLabels = [];
        $serviceData = [];

        foreach ($services as $service) {
            $serviceLabels[] = $service->getNom();
            $serviceData[] = 1;  // 🔥 tu peux remplacer par un vrai compteur si tu veux
        }

        return $this->render('dentiste/dashboard.html.twig', [
            'labels' => json_encode($labels),
            'data' => json_encode($data),

            // 🔥 Envoi des nouvelles variables au Twig
            'serviceLabels' => json_encode($serviceLabels),
            'serviceData' => json_encode($serviceData),
        ]);
    }
}
