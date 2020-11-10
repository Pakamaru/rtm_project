<?php


namespace App\Controller;


use App\Entity\ReservationItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('userManual/homepage.html.twig');
    }

    /**
     * @Route("/reserve/{week}/{chosenDate}", name="reservations", requirements={"week"="\d+"})
     */
    public function reserve(int $week = 0, string $chosenDate = NULL)
    {
        if($week == 999)
        {
            $this->addFlash('error', "You can't go further back than the current week");
            $week = 0;
        }
        $dates = $this->getWeek($week);
        $reservationItems = $this->getDoctrine()
            ->getRepository(ReservationItem::class)
            ->findItemsForToday(date("Y-m-d", strtotime($chosenDate)));

        $chosenDaten = date("Y-m-d", strtotime($chosenDate));

        return $this->render('userManual/reserve.html.twig', [
            'dates' => $dates,
            'currentWeek' => $week,
            'reservationItems' => $reservationItems,
            'chosendate' => $chosenDaten
    ]);
    }


    private function getWeek(int $week)
    {
        $dates = array();
        $monday = strtotime("monday this week +" . $week . "week");

        for($i = 0; $i < 7; $i++)
        {
            $dates[$i] = date("d-M", strtotime('+' . $i . ' day', $monday));
        }

        return $dates;
    }
}