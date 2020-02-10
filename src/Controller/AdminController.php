<?php

namespace App\Controller;

use App\Repository\RoundRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * Class AdminController
 * @package App\Controller
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [

        ]);
    }

    /**
     * @Route("/admin/users", name="admin_users")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function usersList(UserRepository $userRepository)
    {
        $users=$userRepository->findAll();
        return $this->render('admin/user_list.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/admin/rounds", name="admin_rounds")
     * @param RoundRepository $roundRepository
     * @return Response
     */
    public function roundList(RoundRepository $roundRepository)
    {
        $rounds=$roundRepository->findAll();
        return $this->render('admin/round_list.html.twig', [
            'rounds' => $rounds,
        ]);
    }
}
