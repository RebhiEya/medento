<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ServiceController extends AbstractController
{
    #[Route('/dentiste/service', name: 'dentiste_service')]
    public function index(EntityManagerInterface $em): Response
    {
        $services = $em->getRepository(Service::class)->findAll();

        return $this->render('dentiste/service.html.twig', [
            'services' => $services
        ]);
    }

    #[Route('/dentiste/service/add', name: 'service_add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Gestion image
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $fileName = uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('uploads_directory'),
                    $fileName
                );
                $service->setImage($fileName);
            }

            $em->persist($service);
            $em->flush();

            return $this->redirectToRoute('dentiste_service');
        }

        return $this->render('dentiste/add_service.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/dentiste/service/edit/{id}', name: 'service_edit')]
    public function edit(Service $service, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ServiceType::class, $service);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $fileName = uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('uploads_directory'),
                    $fileName
                );
                $service->setImage($fileName);
            }

            $em->flush();
            return $this->redirectToRoute('dentiste_service');
        }

        return $this->render('dentiste/edit_service.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/dentiste/service/delete/{id}', name: 'service_delete')]
    public function delete(Service $service, EntityManagerInterface $em): Response
    {
        $em->remove($service);
        $em->flush();

        return $this->redirectToRoute('dentiste_service');
    }

    
}
