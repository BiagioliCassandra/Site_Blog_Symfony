<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article")
     */
    public function index() : Response
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findById();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'Tous les articles',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/article/{id?1}", name="single", requirements={"id"="\d+"})
     */
    public function single($id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        return $this->render('article/single.html.twig', [
            'controller_name' => 'La page single',
            'article' => $article,
            'id' => $id
        ]);
    }

    /**
     * @Route("/admin/article/add", name="admin_article_add")
     */
    public function add(Request $request) : Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        $articleManager = $this->getDoctrine()->getManager();
        
        if ($form->isSubmitted() && $form->isValid())
        {
            $articleManager->persist($article);
            $articleManager->flush();
            return $this->redirectToRoute('article');
        }

        return $this->render('article/add.html.twig', [
            'controller_name' => 'Ajouter un article',
            'form' => $form->createView()
        ]);
    }
}