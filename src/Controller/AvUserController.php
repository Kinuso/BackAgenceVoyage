<?php

namespace App\Controller;

use App\Entity\AvUser;
use App\Form\AvUserType;
use App\Repository\AvUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/av/user')]
class AvUserController extends AbstractController
{
    #[Route('/', name: 'app_av_user_index', methods: ['GET'])]
    public function index(AvUserRepository $avUserRepository): Response
    {
        return $this->render('av_user/index.html.twig', [
            'av_users' => $avUserRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_av_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avUser = new AvUser();
        $form = $this->createForm(AvUserType::class, $avUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avUser);
            $entityManager->flush();

            return $this->redirectToRoute('app_av_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_user/new.html.twig', [
            'av_user' => $avUser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_user_show', methods: ['GET'])]
    public function show(AvUser $avUser): Response
    {
        return $this->render('av_user/show.html.twig', [
            'av_user' => $avUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_av_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AvUser $avUser, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvUserType::class, $avUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_av_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('av_user/edit.html.twig', [
            'av_user' => $avUser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_av_user_delete', methods: ['POST'])]
    public function delete(Request $request, AvUser $avUser, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avUser->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($avUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_av_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
