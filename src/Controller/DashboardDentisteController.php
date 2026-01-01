<?php

namespace App\Controller;

use App\Repository\RendezVousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardDentisteController extends AbstractController
{
    #[Route('/dentiste/dashboard', name: 'dentiste_dashboard')]
    public function dashboard(RendezVousRepository $repo): Response
    {
        $stats = $repo->countRendezVousByDay();

        $labels = [];
        $data = [];

        foreach ($stats as $row) {
            $labels[] = $row['day'];
            $data[] = $row['total'];
        }

        return $this->render('dentiste/dashboard.html.twig', [
            'labels' => json_encode($labels),
            'data'   => json_encode($data),
        ]);
    }
}
