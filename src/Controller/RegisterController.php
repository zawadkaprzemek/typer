<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use App\Repository\UserTypeRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param UserTypeRepository $userTypeRepository
     * @return RedirectResponse|Response
     * @throws \Exception
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder, UserTypeRepository $userTypeRepository)
    {
        if($this->isGranted('ROLE_USER')){
            return $this->redirectToRoute('app_login');
        }

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setType($userTypeRepository->findOneBy(array('name'=>'User')));
            $user->setCreatedAt(new DateTime());
            $user->setUpdatedAt(new DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $user->getImage();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            try {
                $file->move(
                    $this->getParameter('upload_image_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                $e->getMessage();
            }

            $user->setImage($fileName);
            $user->setAvatar($user->getImage());

            $entityManager->persist($user);
            $entityManager->flush();

            // TO DO dodać wysyłanie maila z potwierdzeniem rejestacji

            return $this->redirectToRoute('app_login');
        }

        return $this->render(
            'register/index.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}
