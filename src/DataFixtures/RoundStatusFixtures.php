<?php

namespace App\DataFixtures;

use App\Entity\RoundStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RoundStatusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $status1=new RoundStatus();
        $status1->setName('Otwarta')->setBetOpen(true);
        $status2=new RoundStatus();
        $status2->setName("Zamknięta")->setBetOpen(false);
        $status3=new RoundStatus();
        $status3->setName("Rozliczona")->setBetOpen(false);

        $manager->persist($status1);
        $manager->persist($status2);
        $manager->persist($status3);
        $manager->flush();
    }
}
