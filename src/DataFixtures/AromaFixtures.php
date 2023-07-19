<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Aroma;
use App\Entity\Beverage;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AromaFixtures extends Fixture implements DependentFixtureInterface
{
    public const AROMAS = ['fraise', 'mangue', 'litchi', 'melon', 'coco', 'vanille', 'taro', 'thé de jasmin', 'rose', 'café', 'banane', 'ananas', 'citron vert', 'framboise'];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $beverages = $manager->getRepository(Beverage::class)->findAll();

        foreach ($beverages as $beverage) {
            $aromaKey = $faker->randomElement((array_keys(self::AROMAS)));
            $aromaName = self::AROMAS[$aromaKey];

            $aroma = new Aroma();
            $aroma->setName($aromaName);

            $referenceName = 'aroma_' . $aromaKey;
            if ($this->hasReference($referenceName)) {
                $this->setReference($referenceName, $aroma);
            } else {
                $this->addReference($referenceName, $aroma);
            }

            $manager->persist($aroma);
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
