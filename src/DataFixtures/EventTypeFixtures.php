<?php

namespace App\DataFixtures;

use App\Entity\EventType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EventTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $type1=new EventType();
        $type1->setName('Mecz');
        $type2=new EventType();
        $type2->setName('Ile goli');
        $type3=new EventType();
        $type3->setName('Czerwona kartka');
        $type4=new EventType();
        $type4->setName('Pracownik miesiąca');
        $type5=new EventType();
        $type5->setName("Rozrywka");

        $manager->persist($type1);
        $manager->persist($type2);
        $manager->persist($type3);
        $manager->persist($type4);
        $manager->persist($type5);
        $manager->flush();
    }
}
