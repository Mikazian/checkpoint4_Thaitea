<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Order;
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

        $orders = $manager->getRepository(Order::class)->findAll();

        foreach ($orders as $order) {
            // Create at least one OrderItem for each Order
            for ($i = 0; $i < 3; $i++) {
                $orderItem = new OrderItem();

                // Size
                $sizes = array_keys(SizeFixtures::MULTIPLICATOR);
                $randomSize = $faker->randomElement($sizes);
                $orderItem->setSize($this->getReference('size_' . $randomSize));

                // Beverage
                $indexBeverage = $faker->numberBetween(0, BeverageFixtures::BEVERAGES_COUNT - 1);
                $orderItem->setBeverage($this->getReference('beverage_' . $indexBeverage));

                // Set the Order for the OrderItem
                $orderItem->setOrderId($order);

                $manager->persist($orderItem);
            }
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
