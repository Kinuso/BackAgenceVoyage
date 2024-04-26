<?php

namespace App\Controller;

use App\Entity\AvCountry;
use App\Form\AvCountryType;
use App\Repository\AvCountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/av/country')]
class AvCountryController extends AbstractController
{
    #[Route('/', name: 'app_av_country_index', methods: ['GET'])]
    public function index(AvCountryRepository $avCountryRepository): Response
    {
        return $this->render('av_country/index.html.twig', [
            'av_countries' => $avCountryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_av_country_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avCountry = new AvCountry();
        $form = $this->createForm(AvCountryType::class, $avCountry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avCountry);
            $entityManager->flush();

            return $this->redirectToRoute('app_av_country_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_country/new.html.twig', [
            'av_country' => $avCountry,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_country_show', methods: ['GET'])]
    public function show(AvCountry $avCountry): Response
    {
        return $this->render('av_country/show.html.twig', [
            'av_country' => $avCountry,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_av_country_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AvCountry $avCountry, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvCountryType::class, $avCountry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_av_country_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_country/edit.html.twig', [
            'av_country' => $avCountry,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_country_delete', methods: ['POST'])]
    public function delete(Request $request, AvCountry $avCountry, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avCountry->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($avCountry);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_av_country_index', [], Response::HTTP_SEE_OTHER);
    }
}
