<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DentisteController extends AbstractController
{
    #[Route('/dentiste', name: 'app_dentiste')]
    public function index(): Response
    {
        return $this->render('dentiste/index.html.twig', [
            'controller_name' => 'DentisteController',
        ]);
    }

    #[Route('/dentiste/dashboard', name: 'dentiste_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('dentiste/dashboard.html.twig');
    }
}
