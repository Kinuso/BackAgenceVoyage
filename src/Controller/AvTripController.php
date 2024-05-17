<?php

namespace App\Controller;

use App\Entity\AvTrip;
use App\Form\AvTripType;
use App\Repository\AvTripRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/av/trip')]
class AvTripController extends AbstractController
{

    #[Route('/', name: 'app_av_trip_index', methods: ['GET'])]
    public function index(AvTripRepository $avTripRepository): Response
    {
        $user = $this->getUser();
        return $this->render('av_trip/index.html.twig', [

            'av_trips' => $avTripRepository->findAll(),
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_av_trip_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avTrip = new AvTrip();
        $form = $this->createForm(AvTripType::class, $avTrip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avTrip);
            $entityManager->flush();

            return $this->redirectToRoute('app_av_trip_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_trip/new.html.twig', [
            'av_trip' => $avTrip,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_trip_show', methods: ['GET'])]
    public function show(AvTrip $avTrip): Response
    {
        return $this->render('av_trip/show.html.twig', [
            'av_trip' => $avTrip,
        ]);
    }  

    #[Route('/{id}/edit', name: 'app_av_trip_edit', methods: ['GET', 'POST'])]
    #[IsGranted(['ROLE_EDITEUR','ROLE_ADMIN'])]
    public function edit(Request $request, AvTrip $avTrip, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvTripType::class, $avTrip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_av_trip_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_trip/edit.html.twig', [
            'av_trip' => $avTrip,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_trip_delete', methods: ['POST'])]
    public function delete(Request $request, AvTrip $avTrip, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $avTrip->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($avTrip);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_av_trip_index', [], Response::HTTP_SEE_OTHER);
    }
}
