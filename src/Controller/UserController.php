<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return new Response('Welcome to Gym World!');
    }

    /**
     * @Route("/reserve/{date}")
     */
    public function reserve($date)
    {
        return new Response(sprintf('List of dates "%s"', $date));
    }
}