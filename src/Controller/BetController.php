<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BetController extends AbstractController
{
    /**
     * @Route("/bet", name="bet")
     */
    public function index()
    {
        return $this->render('bet/index.html.twig', [
            'controller_name' => 'BetController',
        ]);
    }
}
