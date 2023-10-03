<?php

namespace App\Controller;

use App\Repository\TripRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TripController extends AbstractController
{
    #[Route('/trip', name: 'app_trip')]
    public function index(TripRepository $tripRepository): Response
    {
        $trips = $tripRepository->findAll();
        return $this->render('trip/index.html.twig', [
            'controller_name' => 'TripController',
        ]);
    }
}