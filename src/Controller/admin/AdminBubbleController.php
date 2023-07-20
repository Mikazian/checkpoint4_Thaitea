<?php

namespace App\Controller\admin;

use App\Entity\Bubble;
use App\Form\BubbleType;
use App\Repository\BubbleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/bubble')]
class AdminBubbleController extends AbstractController
{
    #[Route('/', name: 'app_admin_bubble_index', methods: ['GET'])]
    public function index(BubbleRepository $bubbleRepository): Response
    {
        $bubbles = $bubbleRepository->findBy([], [
            'name' => 'ASC',
        ]);

        return $this->render('admin/bubble/index.html.twig', [
            'bubbles' => $bubbles,
        ]);
    }

    #[Route('/ajouter', name: 'app_admin_bubble_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bubble = new Bubble();
        $form = $this->createForm(BubbleType::class, $bubble);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bubble);
            $entityManager->flush();
            $this->addFlash("success", "Vous avez ajouter un nouveau bubble !");

            return $this->redirectToRoute('app_admin_bubble_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/bubble/new.html.twig', [
            'bubble' => $bubble,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_bubble_show', methods: ['GET'])]
    public function show(Bubble $bubble): Response
    {
        return $this->render('admin/bubble/show.html.twig', [
            'bubble' => $bubble,
        ]);
    }

    #[Route('/{id}/modifier', name: 'app_admin_bubble_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bubble $bubble, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BubbleType::class, $bubble);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash("success", "Votre bubble a été modifié !");


            return $this->redirectToRoute('app_admin_bubble_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/bubble/edit.html.twig', [
            'bubble' => $bubble,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_bubble_delete', methods: ['POST'])]
    public function delete(Request $request, Bubble $bubble, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $bubble->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bubble);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_bubble_index', [], Response::HTTP_SEE_OTHER);
    }
}
