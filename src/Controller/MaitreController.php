<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\FileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            'articles' => $articleRepository->findBy(['category' => 3]),
        ]);
    }
}
