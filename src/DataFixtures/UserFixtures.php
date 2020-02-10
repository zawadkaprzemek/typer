<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userType=new UserType();
        $userType->setName('User');
        $adminType=new UserType();
        $adminType->setName('Admin');
        $manager->persist($userType);
        $manager->persist($adminType);
        $manager->flush();

        $user1=new User();
        $admin=new User();
        $user1->setType($userType)->setUsername('user')->setEmail('user@user.com')->setCreatedAt(new \DateTime())->setUpdatedAt(new \DateTime());
        $passwordu = $this->encoder->encodePassword($user1, 'user');
        $user1->setPassword($passwordu);
        $admin->setType($adminType)->setUsername('admin')->setEmail('admin@user.com')->setCreatedAt(new \DateTime())->setUpdatedAt(new \DateTime());
        $passworda = $this->encoder->encodePassword($admin, 'admin');
        $admin->setPassword($passworda);
        $manager->persist($user1);
        $manager->persist($admin);
        $manager->flush();
    }
}
