<?php

namespace App\Controller;

use App\Entity\AvCategory;
use App\Form\AvCategoryType;
use App\Repository\AvCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/av/category')]
class AvCategoryController extends AbstractController
{
    #[Route('/', name: 'app_av_category_index', methods: ['GET'])]
    public function index(AvCategoryRepository $avCategoryRepository): Response
    {
        return $this->render('av_category/index.html.twig', [
            'av_categories' => $avCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_av_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avCategory = new AvCategory();
        $form = $this->createForm(AvCategoryType::class, $avCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avCategory);
            $entityManager->flush();

            return $this->redirectToRoute('app_av_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_category/new.html.twig', [
            'av_category' => $avCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_category_show', methods: ['GET'])]
    public function show(AvCategory $avCategory): Response
    {
        return $this->render('av_category/show.html.twig', [
            'av_category' => $avCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_av_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AvCategory $avCategory, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvCategoryType::class, $avCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_av_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_category/edit.html.twig', [
            'av_category' => $avCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_category_delete', methods: ['POST'])]
    public function delete(Request $request, AvCategory $avCategory, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avCategory->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($avCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_av_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
