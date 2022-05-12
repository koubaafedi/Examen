<?php

namespace App\Controller;

use App\Entity\FKArticle;
use App\Form\FKArticleType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fk/article')]
class FKArticleController extends AbstractController
{
    #[Route('/', name: 'article.all')]
    public function fkindex(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(FKArticle::class);
        $articles = $repository->findAll();
        return $this->render('fk_article/index.html.twig', [
            'articles' => $articles,
        ]);
    }
    #[Route('/add', name: 'article.add')]
    public function fkadd(Request $request,ManagerRegistry $doctrine): Response
    {
        $article=new FKArticle();
        $form=$this->createForm(FKArticleType::class,$article);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $manager=$doctrine->getManager();
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute(
                'article.all',
            );
        }else{
            return $this->render('fk_article/form.html.twig',
                ['form'=>$form->createView()]
            );
        }

    }
    #[Route('/details/{id}', name: 'article.details')]
    public function fkdetail(FKArticle $article=null): Response
    {

        return $this->render('fk_article/detail.html.twig', [
            'article' => $article,
        ]);
    }
    #[Route('/edit/{id?0}', name: 'article.edit')]
    public function fkedit(Request $request,ManagerRegistry $doctrine,FKArticle $article=null): Response
    {
        if (!$article){
            $article=new FKArticle();
        }
        $form=$this->createForm(FKArticleType::class,$article);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $manager=$doctrine->getManager();
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute(
                'article.all',
            );
        }else{
            return $this->render('fk_article/form.html.twig',
                ['form'=>$form->createView()]
            );
        }

    }
    #[Route('/delete/{id?0}', name: 'article.delete')]
    public function fkdelete(Request $request,ManagerRegistry $doctrine,FKArticle $article=null): Response
    {
        if ($article){
            $manager=$doctrine->getManager();
            $manager->remove($article);
            $manager->flush();

        }
        return $this->redirectToRoute(
            'article.all',
        );

    }
}
