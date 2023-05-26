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
        ]);
    }

    #[Route('/{id}', name: '_show', methods: ['GET'])]
    public function show(Categorie $categorie): Response
    {

        return $this->render('quizz/show.html.twig', [
            'questions' => $categorie->getQuestions(),
        ]);
    }


}
