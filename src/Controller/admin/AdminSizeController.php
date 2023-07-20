<?php

namespace App\Controller\admin;

use App\Entity\Size;
use App\Form\SizeType;
use App\Repository\SizeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/taille')]
class AdminSizeController extends AbstractController
{
    #[Route('/', name: 'app_admin_size_index', methods: ['GET'])]
    public function index(SizeRepository $sizeRepository): Response
    {
        $sizes = $sizeRepository->findBy([], [
            'volume' => 'DESC',
        ]);

        return $this->render('admin/size/index.html.twig', [
            'sizes' => $sizes,
        ]);
    }

    #[Route('/ajouter', name: 'app_admin_size_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $size = new Size();
        $form = $this->createForm(SizeType::class, $size);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($size);
            $entityManager->flush();
            $this->addFlash("success", "Vous avez ajouter un nouveau liquide !");

            return $this->redirectToRoute('app_admin_size_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/size/new.html.twig', [
            'size' => $size,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/modifier', name: 'app_admin_size_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Size $size, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SizeType::class, $size);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash("success", "Votre taille a été modifié !");

            return $this->redirectToRoute('app_admin_size_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/size/edit.html.twig', [
            'size' => $size,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_size_delete', methods: ['POST'])]
    public function delete(Request $request, Size $size, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $size->getId(), $request->request->get('_token'))) {
            $entityManager->remove($size);
            $entityManager->flush();

            $this->addFlash("success", "Votre taille a été supprimé !");
        }

        return $this->redirectToRoute('app_admin_size_index', [], Response::HTTP_SEE_OTHER);
    }
}
