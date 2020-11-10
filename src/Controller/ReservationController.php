<?php

namespace App\Controller;

use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }

    /**
     * @Route("/reservaton", name="createReservation")
     */
    public function createReservation(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $reservation = new Reservation();

        $entityManager->persist($reservation);
        $entityManager->flush();

        return new Response('You made a reservation');
    }
}
