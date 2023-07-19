<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Order;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    public const ORDER_COUNT = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= self::ORDER_COUNT; $i++) {
            $order = new Order();
            $order->setNumber($i);
            $order->setDate($faker->dateTime('d/m/Y'));
            $order->setClientId($this->getReference('admin'));

            $this->addReference('order_' . $i, $order);

            $manager->persist($order);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
