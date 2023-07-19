<?php

namespace App\DataFixtures;

use App\Entity\Aroma;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AromaFixtures extends Fixture
{
    public const AROMAS = ['fraise', 'mangue', 'litchi', 'melon', 'coco', 'vanille', 'taro', 'thé de jasmin', 'rose', 'café', 'banane', 'ananas', 'citron vert', 'framboise'];

    public function load(ObjectManager $manager): void
    {
        // Créer et persister les arômes
        foreach (self::AROMAS as $key => $aromaName) {
            $aroma = new Aroma();
            $aroma->setName($aromaName);

            $this->addReference('aroma_' . $key, $aroma);

            $manager->persist($aroma);
        }

        $manager->flush();
    }
}
