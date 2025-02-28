<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie')]
class CategorieController extends AbstractController
{
    #[Route('/', name: 'app_categorie_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager
            ->getRepository(Categorie::class)
            ->findAll();

        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
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

    #[Route('/new', name: 'app_categorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie/new.html.twig', [
            'categorie' => $categorie,
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

    #[Route('/{id}', name: 'app_categorie_show', methods: ['GET'])]
    public function show(Categorie $categorie): Response
    {
        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categorie $categorie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie/edit.html.twig', [
            'categorie' => $categorie,
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

    #[Route('/{id}', name: 'app_categorie_delete', methods: ['POST'])]
    public function delete(Request $request, Categorie $categorie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
