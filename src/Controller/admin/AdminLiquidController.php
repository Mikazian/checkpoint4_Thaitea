<?php

namespace App\Controller\admin;

use App\Entity\Liquid;
use App\Form\LiquidType;
use App\Repository\LiquidRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/liquide')]
class AdminLiquidController extends AbstractController
{
    #[Route('/', name: 'app_admin_liquid_index', methods: ['GET'])]
    public function index(LiquidRepository $liquidRepository): Response
    {
        return $this->render('admin/liquid/index.html.twig', [
            'liquids' => $liquidRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: 'app_admin_liquid_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $liquid = new Liquid();
        $form = $this->createForm(LiquidType::class, $liquid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($liquid);
            $entityManager->flush();
            $this->addFlash("success", "Vous avez ajouter un nouveau liquide !");

            return $this->redirectToRoute('app_admin_liquid_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/liquid/new.html.twig', [
            'liquid' => $liquid,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/modifier', name: 'app_admin_liquid_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Liquid $liquid, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LiquidType::class, $liquid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash("success", "Votre liquide a été supprimé !");

            return $this->redirectToRoute('app_admin_liquid_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/liquid/edit.html.twig', [
            'liquid' => $liquid,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_liquid_delete', methods: ['POST'])]
    public function delete(Request $request, Liquid $liquid, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $liquid->getId(), $request->request->get('_token'))) {
            $entityManager->remove($liquid);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_liquid_index', [], Response::HTTP_SEE_OTHER);
    }
}
