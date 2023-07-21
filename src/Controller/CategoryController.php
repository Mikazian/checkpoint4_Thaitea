<?php

namespace App\Controller;

use App\Repository\BeverageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie', name: 'app_category_')]
class CategoryController extends AbstractController
{
    #[Route('/milk-tea', name: 'milk_tea')]
    public function milkTea(BeverageRepository $beverageRepository): Response
    {
        $beverages = $beverageRepository->findBeveragesWithMilks();

        return $this->render('category/index.html.twig', [
            'beverages' => $beverages,
        ]);
    }

    #[Route('/matcha-tea', name: 'matcha_tea')]
    public function matchaTea(BeverageRepository $beverageRepository): Response
    {
        $beverages = $beverageRepository->findBeveragesWithMatchas();

        return $this->render('category/index.html.twig', [
            'beverages' => $beverages,
        ]);
    }

    #[Route('/sugar-brown-tea', name: 'sugar_brown')]
    public function sugarBrownTea(BeverageRepository $beverageRepository): Response
    {
        $beverages = $beverageRepository->findBeveragesWithSugarBrowns();

        return $this->render('category/index.html.twig', [
            'beverages' => $beverages,
        ]);
    }

    #[Route('/fruit-tea', name: 'fruit_tea')]
    public function fruitTea(BeverageRepository $beverageRepository): Response
    {
        $beverages = $beverageRepository->findBeveragesWithTeas();

        return $this->render('category/index.html.twig', [
            'beverages' => $beverages,
        ]);
    }
}
