<?php


namespace App\Controller;


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
        return $this->render('user/homepage.html.twig');
    }

    /**
     * @Route("/reserve/{week}", name="reservations", requirements={"week"="\d+"})
     */
    public function reserve(int $week = 1)
    {
        if($week < 1)
        {
            $this->addFlash('error', "You can't go further back than the current week");
            $week = 1;
        }
        $dates = $this->getWeek($week);
        return $this->render('user/reserve.html.twig', [
            'dates' => $dates,
            'currentWeek' => $week
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