<?php

namespace App\Controller;

use App\Repository\RendezVousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DentisteRendezVousController extends AbstractController
{
    #[Route('/dentiste/rendezvous', name: 'dentiste_rendezvous')]
    public function index(RendezVousRepository $rvRepo): Response
    {
        $rendezVous = $rvRepo->findBy([], ['date' => 'DESC']);

        return $this->render('dentiste/rendezvous.html.twig', [
            'rendezVous' => $rendezVous
        ]);
    }
}
