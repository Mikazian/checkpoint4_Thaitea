<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Liquid;
use App\Entity\Beverage;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LiquidFixtures extends Fixture implements DependentFixtureInterface
{
    public const LIQUID = ['lait', 'lait végétal', 'matcha', 'sugar brown', 'thé noir', 'thé vert', 'jus de fruit'];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $beverages = $manager->getRepository(Beverage::class)->findAll();

        foreach ($beverages as $beverage) {
            $liquidKey = $faker->randomElement(array_keys(self::LIQUID));
            $liquidName = self::LIQUID[$liquidKey];

            $liquid = new Liquid();
            $liquid->setName($liquidName);

            $referenceName = 'liquid_' . $liquidKey;
            if ($this->hasReference($referenceName)) {
                $this->setReference($referenceName, $liquid);
            } else {
                $this->addReference($referenceName, $liquid);
            }

            $manager->persist($liquid);
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
