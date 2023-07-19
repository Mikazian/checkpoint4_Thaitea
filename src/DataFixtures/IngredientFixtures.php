<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Beverage;
use App\Entity\Ingredient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class IngredientFixtures extends Fixture implements DependentFixtureInterface
{
    public const INGREDIENTS = [
        'fruits frais mangues',
        'fruits frais melons',
        'fruits frais oranges',
        'fruits frais pamplemousse',
        'fruits frais citron vert',
        'fruits frais ananas',
        'fruits frais fraises',
        'fruits frais kiwis',
        'fruits frais litchi',
        'fruits frais coco',
        'fruits frais cerise',
        'aloe verra',
        'nata de coco',
        'crème',
        'jelly',
        'sauce au chocolat',
        'sauce au caramel',
        'poudre de matcha',
        'glace',
        'mousse de thé',
        'céréales croquantes',
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $beverages = $manager->getRepository(Beverage::class)->findAll();

        foreach ($beverages as $beverage) {
            $ingredientKey = $faker->randomElement(array_keys(self::INGREDIENTS));
            $ingredientName = self::INGREDIENTS[$ingredientKey];

            $ingredient = new Ingredient();
            $ingredient->setName($ingredientName);
            $ingredient->addBeverage($beverage);

            $referenceName = 'ingredient_' . $ingredientKey;
            if ($this->hasReference($referenceName)) {
                $this->setReference($referenceName, $ingredient);
            } else {
                $this->addReference($referenceName, $ingredient);
            }

            $manager->persist($ingredient);
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
