<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Beverage;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BeverageFixtures extends Fixture implements DependentFixtureInterface
{
    public const BEVERAGES_COUNT = 20;
    public const PRICE = [6.50, 7, 7.50, 8, 8.50, 9];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i <= self::BEVERAGES_COUNT; $i++) {
            $beverage = new Beverage();
            $beverage->setName($faker->word());
            $beverage->setPrice($faker->randomElement(self::PRICE));

            $beverage->setCreatorId($this->getReference('admin'));
            $this->addReference('beverage_' . $i, $beverage);

            $manager->persist($beverage);
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
