<?php

namespace App\DataFixtures;

use App\Entity\Bubble;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BubbleFixtures extends Fixture
{
    public const BUBBLES = [
        'perles de tapioca',
        'perles de sagou',
        'perles de konjac',
        'perles de de jelly',
        'perles de d\'agar-agar',
        'perles de coco',
        'perles de fruit du dragon',
        'perles de litchi',
        'perles de passion fruit',
        'perles de pamplemousse',
        'perles de de mangue',
        'perles de kiwi',
        'perles de fraise',
        'perles de melon',
        'perles de lychee',
    ];


    public function load(ObjectManager $manager): void
    {
        foreach (self::BUBBLES as $key => $bubbleName) {
            $bubble = new Bubble();
            $bubble->setName($bubbleName);

            $this->addReference('bubble_' . $key, $bubble);

            $manager->persist($bubble);
        }

        $manager->flush();
    }
}
