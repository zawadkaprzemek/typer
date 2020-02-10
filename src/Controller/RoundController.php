<?php

namespace App\Controller;

use App\Entity\Round;
use App\Form\RoundType;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoundController extends AbstractController
{
    use TimestampableEntity;
    /**
     * @Route("/round", name="round")
     */
    public function index()
    {
        return $this->render('round/index.html.twig', [
            'controller_name' => 'RoundController',
        ]);
    }

    /**
     * @Route("/round/add", name="app_round_new")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function newRound(Request $request)
    {
        $round=new Round();
        $form=$this->createForm(RoundType::class,$round);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($round);
            $entityManager->flush();

            $this->addFlash('success', 'Dodano nową rundę');
            return $this->redirectToRoute('app_home');
        }
        return $this->render(
            'round/new.html.twig',
            array(
                'form' => $form->createView(),
                'round' => $round,
                'header'=>'Dodaj nową rundę'
            )
        );
    }

    /**
     * @Route("/round/{id}/show", name="app_round_show")
     * @param Round $round
     */
    public function showRound(Round $round)
    {

    }

    /**
     * @Route("/round/{id}/add_event", name="app_round_add_event")
     * @param Round $round
     * @param Request $request
     */
    public function roundAddEvent(Round $round, Request $request)
    {

    }


}
