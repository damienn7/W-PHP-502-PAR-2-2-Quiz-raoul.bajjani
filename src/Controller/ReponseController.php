<?php

namespace App\Controller;

use App\Entity\Reponse;
use App\Form\ReponseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reponse')]
class ReponseController extends AbstractController
{
    #[Route('/', name: 'app_reponse_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reponses = $entityManager
            ->getRepository(Reponse::class)
            ->findAll();

        return $this->render('reponse/index.html.twig', [
            'reponses' => $reponses,
            'items' => [[
                'route' => 'app_question_index',
                'title' => 'Question'
            ],[
                'route' => 'app_categorie_index',
                'title' => 'Category'
            ],[
                'route' => 'app_reponse_index',
                'title' => 'Answer'
            ],[
                'route' => 'app_user_index',
                'title' => 'User'
            ],[
                'route' => 'app_quizz_index',
                'title' => 'Quizz'
            ],[
                'route' => 'app_logout',
                'title' => 'Logout'
            ]],
        ]);
    }

    #[Route('/new', name: 'app_reponse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reponse = new Reponse();
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reponse);
            $entityManager->flush();

            return $this->redirectToRoute('app_reponse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reponse/new.html.twig', [
            'reponse' => $reponse,
            'form' => $form,
            'items' => [[
                'route' => 'app_question_index',
                'title' => 'Question'
            ],[
                'route' => 'app_categorie_index',
                'title' => 'Category'
            ],[
                'route' => 'app_reponse_index',
                'title' => 'Answer'
            ],[
                'route' => 'app_user_index',
                'title' => 'User'
            ],[
                'route' => 'app_quizz_index',
                'title' => 'Quizz'
            ],[
                'route' => 'app_logout',
                'title' => 'Logout'
            ]],
        ]);
    }

    #[Route('/{id}', name: 'app_reponse_show', methods: ['GET'])]
    public function show(Reponse $reponse): Response
    {
        return $this->render('reponse/show.html.twig', [
            'reponse' => $reponse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reponse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reponse $reponse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reponse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reponse/edit.html.twig', [
            'reponse' => $reponse,
            'form' => $form,
            'items' => [[
                'route' => 'app_question_index',
                'title' => 'Question'
            ],[
                'route' => 'app_categorie_index',
                'title' => 'Category'
            ],[
                'route' => 'app_reponse_index',
                'title' => 'Answer'
            ],[
                'route' => 'app_user_index',
                'title' => 'User'
            ],[
                'route' => 'app_quizz_index',
                'title' => 'Quizz'
            ],[
                'route' => 'app_logout',
                'title' => 'Logout'
            ]],
        ]);
    }

    #[Route('/{id}', name: 'app_reponse_delete', methods: ['POST'])]
    public function delete(Request $request, Reponse $reponse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reponse->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reponse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reponse_index', [], Response::HTTP_SEE_OTHER);
    }
}
