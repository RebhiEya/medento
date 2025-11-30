<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SecretaireController extends AbstractController
{
    #[Route('/secretaire', name: 'app_secretaire')]
    public function index(): Response
    {
        return $this->redirectToRoute('secretaire_dashboard');
    }

    #[Route('/secretaire/dashboard', name: 'secretaire_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('secretaire/dashboard.html.twig');
    }
}
