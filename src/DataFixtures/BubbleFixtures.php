<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Bubble;
use App\Entity\Beverage;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BubbleFixtures extends Fixture implements DependentFixtureInterface
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
        $faker = Factory::create('fr_FR');

        $beverages = $manager->getRepository(Beverage::class)->findAll();

        foreach ($beverages as $beverage) {
            $bubbleKey = $faker->randomElement((array_keys(self::BUBBLES)));
            $bubbleName = self::BUBBLES[$bubbleKey];

            $bubble = new Bubble();
            $bubble->setName($bubbleName);

            $referenceName = 'bubble_' . $bubbleKey;
            if ($this->hasReference($referenceName)) {
                $this->setReference($referenceName, $bubble);
            } else {
                $this->addReference($referenceName, $bubble);
            }

            $manager->persist($bubble);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BeverageFixtures::class,
        ];
    }
}
