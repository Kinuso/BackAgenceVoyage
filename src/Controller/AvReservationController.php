<?php

namespace App\Controller;

use App\Entity\AvReservation;
use App\Form\AvReservationType;
use App\Repository\AvReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/av/reservation')]
class AvReservationController extends AbstractController
{
    #[Route('/', name: 'app_av_reservation_index', methods: ['GET'])]
    public function index(AvReservationRepository $avReservationRepository): Response
    {
        return $this->render('av_reservation/index.html.twig', [
            'av_reservations' => $avReservationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_av_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avReservation = new AvReservation();
        $form = $this->createForm(AvReservationType::class, $avReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avReservation);
            $entityManager->flush();

            return $this->redirectToRoute('app_av_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_reservation/new.html.twig', [
            'av_reservation' => $avReservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_reservation_show', methods: ['GET'])]
    public function show(AvReservation $avReservation): Response
    {
        return $this->render('av_reservation/show.html.twig', [
            'av_reservation' => $avReservation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_av_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AvReservation $avReservation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvReservationType::class, $avReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_av_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_reservation/edit.html.twig', [
            'av_reservation' => $avReservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, AvReservation $avReservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avReservation->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($avReservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_av_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
