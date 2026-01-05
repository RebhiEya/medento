<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DentistePatientController extends AbstractController
{
    #[Route('/dentiste/patients', name: 'dentiste_patients')]
    public function index(UserRepository $userRepo): Response
    {
        $patients = $userRepo->findPatients();

        return $this->render('dentiste/patients.html.twig', [
            'patients' => $patients
        ]);
    }
}
