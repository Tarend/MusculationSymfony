<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;

class ArticlesController extends AbstractController
{

    /**
     * @Route("/articles", name="app_articles_index", methods="GET")
     */
    public function index(ArticlesRepository $articlesRepository)
    {
        $articles = $articlesRepository ->findAll();
        return $this->render('articles\index.html.twig',['articles'=>$articles]);
    }
    /**
     * @Route("/articles/{titre}", name="article")
     */
    public function aaa(ArticlesRepository $repository, $titre)
    {
        $articlesPage = $repository->findBy(['titre' => $titre]);
        return $this->render('articles/index.html.twig', [
            'articles' => $articlesPage
        ]);
    }


    /**
     * @Route("articles/create", name="app_articles_create", methods={"GET","POST"})
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $articles = new Articles();
        // Créer le formulatire
        $form = $this->createForm(Articles::class, $articles);
        // Créer la soumission du formulaire
        // Analyser la requete HTTP
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($articles);
            $manager->flush();
            // Flash message
            $this->addFlash('success', 'Article ajouté avec succes');
            return $this->redirectToRoute('app_articles_index');
        }
        // Appel à la vue pour afficher le formulaire
        return $this->render('articles/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
