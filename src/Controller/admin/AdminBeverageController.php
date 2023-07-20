<?php

namespace App\Controller\admin;

use App\Entity\Beverage;
use App\Form\BeverageType;
use App\Repository\BeverageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/bubbletea')]
class AdminBeverageController extends AbstractController
{
    #[Route('/', name: 'app_admin_beverage_index', methods: ['GET'])]
    public function index(BeverageRepository $beverageRepository): Response
    {
        $beverages = $beverageRepository->findBy([], [
            'name' => 'ASC',
        ]);

        return $this->render('admin/beverage/index.html.twig', [
            'beverages' => $beverages,
        ]);
    }

    #[Route('/ajouter', name: 'app_admin_beverage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $beverage = new Beverage();
        $form = $this->createForm(BeverageType::class, $beverage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($beverage);
            $entityManager->flush();

            $this->addFlash("success", "Vous avez ajouter un nouveau Bubble Tea !");

            return $this->redirectToRoute('app_admin_beverage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/beverage/new.html.twig', [
            'beverage' => $beverage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_beverage_show', methods: ['GET'])]
    public function show(Beverage $beverage): Response
    {
        return $this->render('admin/beverage/show.html.twig', [
            'beverage' => $beverage,
        ]);
    }

    #[Route('/{id}/modifier', name: 'app_admin_beverage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Beverage $beverage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BeverageType::class, $beverage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash("success", "Votre Bubble Tea a été modifié !");

            return $this->redirectToRoute('app_admin_beverage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/beverage/edit.html.twig', [
            'beverage' => $beverage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_beverage_delete', methods: ['POST'])]
    public function delete(Request $request, Beverage $beverage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $beverage->getId(), $request->request->get('_token'))) {
            $entityManager->remove($beverage);
            $entityManager->flush();

            $this->addFlash("success", "Votre Bubble Tea a été supprimé !");
        }

        return $this->redirectToRoute('app_admin_beverage_index', [], Response::HTTP_SEE_OTHER);
    }
}
