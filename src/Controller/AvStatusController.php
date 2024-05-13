<?php

namespace App\Controller;

use App\Entity\AvStatus;
use App\Form\AvStatusType;
use App\Repository\AvStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/av/status')]
class AvStatusController extends AbstractController
{
    #[Route('/', name: 'app_av_status_index', methods: ['GET'])]
    public function index(AvStatusRepository $avStatusRepository): Response
    {
        return $this->render('av_status/index.html.twig', [
            'av_statuses' => $avStatusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_av_status_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avStatus = new AvStatus();
        $form = $this->createForm(AvStatusType::class, $avStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avStatus);
            $entityManager->flush();

            return $this->redirectToRoute('app_av_status_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_status/new.html.twig', [
            'av_status' => $avStatus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_status_show', methods: ['GET'])]
    public function show(AvStatus $avStatus): Response
    {
        return $this->render('av_status/show.html.twig', [
            'av_status' => $avStatus,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_av_status_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AvStatus $avStatus, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvStatusType::class, $avStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_av_status_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_status/edit.html.twig', [
            'av_status' => $avStatus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_status_delete', methods: ['POST'])]
    public function delete(Request $request, AvStatus $avStatus, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avStatus->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($avStatus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_av_status_index', [], Response::HTTP_SEE_OTHER);
    }
}
