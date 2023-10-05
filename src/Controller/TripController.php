<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Repository\TripRepository;
use Illuminate\Http\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TripController extends AbstractController
{
    /**
     * @param TripRepository $tripRepository
     * @return Response
     */
    #[Route('/trip', name: 'app_trip')]
    public function index(TripRepository $tripRepository): Response
    {
        $trips = $tripRepository->findAll();
        return $this->render('dashboard/trip/index.html.twig', [
            'controller_name' => 'TripController',
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function addTrip(Request $request): Response
    {
        $currentUser = $this->getUser();
        $trip = new Trip();
        $trip->setDate(new \DateTime($request->request->get('date')));
        $trip->setKm($request->get('km'));
        $trip->setUser($currentUser);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($trip);
        $entityManager->flush();

        return new Response('Saved new trip with!');
    }
}