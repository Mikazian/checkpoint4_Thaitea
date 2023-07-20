<?php

namespace App\Controller\admin;

use App\Entity\Aroma;
use App\Form\AromaType;
use App\Repository\AromaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/arome')]
class AdminAromaController extends AbstractController
{
    #[Route('/', name: 'app_admin_aroma_index', methods: ['GET'])]
    public function index(AromaRepository $aromaRepository): Response
    {
        return $this->render('admin/aroma/index.html.twig', [
            'aromas' => $aromaRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: 'app_admin_aroma_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $aroma = new Aroma();
        $form = $this->createForm(AromaType::class, $aroma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($aroma);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_aroma_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/aroma/new.html.twig', [
            'aroma' => $aroma,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_aroma_show', methods: ['GET'])]
    public function show(Aroma $aroma): Response
    {
        return $this->render('admin/aroma/show.html.twig', [
            'aroma' => $aroma,
        ]);
    }

    #[Route('/{id}/modifier', name: 'app_admin_aroma_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Aroma $aroma, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AromaType::class, $aroma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_aroma_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/aroma/edit.html.twig', [
            'aroma' => $aroma,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_aroma_delete', methods: ['POST'])]
    public function delete(Request $request, Aroma $aroma, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $aroma->getId(), $request->request->get('_token'))) {
            $entityManager->remove($aroma);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_aroma_index', [], Response::HTTP_SEE_OTHER);
    }
}
