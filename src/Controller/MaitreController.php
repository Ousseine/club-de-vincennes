<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\Article3Type;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maitre")
 */
class MaitreController extends AbstractController
{
    /**
     * @Route("/", name="maitre_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('maitre/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }
}
