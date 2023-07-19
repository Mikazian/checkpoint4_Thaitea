<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Beverage;
use App\DataFixtures\AromaFixtures;
use App\DataFixtures\BubbleFixtures;
use App\DataFixtures\LiquidFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BeverageFixtures extends Fixture implements DependentFixtureInterface
{
    public const BEVERAGES_COUNT = 20;
    public const PRICE = [6, 6.50, 7, 7.50, 8];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i <= self::BEVERAGES_COUNT; $i++) {
            $beverage = new Beverage();
            $beverage->setName($faker->word());
            $beverage->setPrice($faker->randomElement(self::PRICE));

            $beverage->setCreatorId($this->getReference('admin'));

            // Aroma
            $numberAromas = count(AromaFixtures::AROMAS);
            $indexAroma = $faker->numberBetween(0, $numberAromas - 1);
            $beverage->setAroma($this->getReference('aroma_' . $indexAroma));

            // Bubble
            $numberBubbles = count(BubbleFixtures::BUBBLES);
            $indexBubble = $faker->numberBetween(0, $numberBubbles - 1);
            $beverage->setBubble($this->getReference('bubble_' . $indexBubble));

            // Liquid
            $numberLiquids = count(LiquidFixtures::LIQUIDS);
            $indexLiquid = $faker->numberBetween(0, $numberLiquids - 1);
            $beverage->setLiquid($this->getReference('liquid_' . $indexLiquid));


            $this->addReference('beverage_' . $i, $beverage);

            $manager->persist($beverage);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            AromaFixtures::class,
        ];
    }
}
