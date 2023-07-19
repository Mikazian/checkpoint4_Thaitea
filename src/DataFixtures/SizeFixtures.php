<?php

namespace App\DataFixtures;

use App\Entity\Size;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SizeFixtures extends Fixture
{
    public const MULTIPLICATOR = [
        500 => 1.00,
        700 => 1.25,
        900 => 1.50,
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::MULTIPLICATOR as $volume => $multiplicator) {
            $size = new Size();
            $size->setVolume($volume);
            $size->setMultiplicator($multiplicator);

            $this->addReference('size_' . $volume, $size);

            $manager->persist($size);
        }

        $manager->flush();
    }
}
