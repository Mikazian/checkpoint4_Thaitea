<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Beverage;
use App\Entity\Ingredient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class IngredientFixtures extends Fixture
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
        foreach (self::INGREDIENTS as $key => $ingredientName) {
            $ingredient = new Ingredient();
            $ingredient->setName($ingredientName);

            $this->addReference('ingredient_' . $key, $ingredient);

            $manager->persist($ingredient);
        }

        $manager->flush();
    }
}
