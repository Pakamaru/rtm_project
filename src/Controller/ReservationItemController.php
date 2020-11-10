<?php

namespace App\Controller;

use App\Entity\ReservationItem;
use App\Form\ReservationItemType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationItemController extends AbstractController
{
    /**
     * @Route("/reservation/item", name="reservation_item")
     */
    public function index(): Response
    {
        return $this->render('reservation_item/index.html.twig', [
            'controller_name' => 'ReservationItemController',
        ]);
    }

    /**
     * @Route("/reservation_item/new", name="create_reservation_item")
     */
    public function new(Request $request)
    {
        $reservationItem = new ReservationItem();

        $form = $this->createForm(ReservationItemType::class, $reservationItem);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            $this->addFlash('success', "successfully added the reservation item!");
            return $this->redirectToRoute('reservation_item');
        }

        return $this->render('reservation_item/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/reservation_item/new_list", name="create_reservation_item_list")
     */
    public function datascript()
    {
        $days = 4;
        $hours = 12;
        $entityManager = $this->getDoctrine()->getManager();
        for($i = 0; $i < $days; $i++){
            for($j = 0; $j < $hours; $j++){
                $reservationItem = new ReservationItem();
                $reservationItem->setName('Fitness & Cardio');
                $reservationItem->setMaxCustomers(30);
                $reservationItem->setDate(new \DateTime('@'.strtotime('today midnight +' . $i . ' days ' . ($j + 10) . ' hours')));
                $entityManager->persist($reservationItem);
            }
        }
        $entityManager->flush();

        $this->addFlash('success', "successfully added the reservation item!");
        return $this->redirectToRoute('reservation_item');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
