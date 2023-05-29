<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;
use App\Entity\Question;
use App\Entity\Reponse;
use App\Entity\User;
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

    // #[Route('/{id}/{question_id}', name: '_show', methods: ['GET'])]
    #[Route('/{id}/{question_id}/{reponse_id}', name: '_show', methods: ['GET','POST'])]
    public function show(Categorie $categorie,$question_id,$reponse_id,Request $request,EntityManagerInterface $entityManager): Response
    {


        if ($request->isMethod('POST')) {
            $reponse = $entityManager->getRepository(Reponse::class)->find($request->request->get("reponse_id"));

        if ($reponse) {
            $reponse->addUser($this->getUser());
            $entityManager->persist($reponse);
            $entityManager->flush();
        }
        
        }else{
            $reponse = new Reponse();
        }
        $question = $categorie->getQuestions()[$question_id];

        if($question_id>count($categorie->getQuestions())-1){
            $score = 0;
            foreach ($categorie->getQuestions() as $key => $question) {
                foreach ($question->getReponses() as $key => $reponse) {
                    foreach($reponse->getUsers() as $user){
                        if($user->getEmail() == $this->getUser()->getUserIdentifier()&&$reponse->getReponseExpected()==1){
                            $score++;
                        }
                    }
                }
            }
        }else{
            $score = 0;
        }

        
        
        return $this->render('quizz/show.html.twig', [
            'question' => $question,
            'count'=>count($categorie->getQuestions()),
            'reponse_id' => $reponse_id,
            'question_id' => $question_id,
            'categorie' => $categorie,
            'user' => $this->getUser(),
            'reponse' => $reponse,
            'user_related' => $reponse->getUsers(),
            'score' => $score,
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

    private function isStarted(Categorie $categorie){
        foreach ($categorie->getQuestions() as $key => $question) {
            foreach ($question->getReponses() as $key => $reponse) {
                foreach($reponse->getUsers() as $user){
                    if($user->getEmail() == $this->getUser()->getUserIdentifier()){
                        return true;
                    }
                }
            }
        }

        return false;
    }

    private function isFinished(Categorie $categorie){
        $count = 0;
        foreach ($categorie->getQuestions() as $key => $question) {
            foreach ($question->getReponses() as $key => $reponse) {
                foreach($reponse->getUsers() as $user){
                    if($user->getEmail() == $this->getUser()->getUserIdentifier()){
                        $count++;
                    }
                }
            }
        }

        if ($count==count($categorie->getQuestions())) {
            return true;
        }

        return false;
    }

}
