<?php

namespace App\DataFixtures;

use App\Entity\Liquid;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LiquidFixtures extends Fixture
{
    public const LIQUIDS = ['lait', 'lait végétal', 'matcha', 'sugar brown', 'thé noir', 'thé vert', 'jus de fruit'];

    public function load(ObjectManager $manager): void
    {
        foreach (self::LIQUIDS as $key => $liquidName) {
            $liquid = new Liquid();
            $liquid->setName($liquidName);

            $this->addReference('liquid_' . $key, $liquid);

            $manager->persist($liquid);
        }

        $manager->flush();
    }
}
