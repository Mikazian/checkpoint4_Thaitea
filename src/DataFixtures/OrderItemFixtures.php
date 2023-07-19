<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\OrderItem;
use App\DataFixtures\SizeFixtures;
use App\DataFixtures\BeverageFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrderItemFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $orderItem = new OrderItem();
            $volumeKeys = array_keys(SizeFixtures::MULTIPLICATOR);
            $volumeKey = $volumeKeys[$i];

            $manager->persist($orderItem);
        }

        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            BeverageFixtures::class,
            SizeFixtures::class,
        ];
    }
}
