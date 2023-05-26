<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

#[Route('/quizz', name: 'app_quizz')]
class QuizzController extends AbstractController
{
    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager
        ->getRepository(Categorie::class)
        ->findAll();
        
        return $this->render('quizz/index.html.twig', [
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

    #[Route('/{id}', name: '_show', methods: ['GET'])]
    public function show(Categorie $categorie): Response
    {

        return $this->render('quizz/show.html.twig', [
            'questions' => $categorie->getQuestions(),
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


}
