<?php

namespace App\Controller;

use App\Entity\File;
use App\Repository\ArticleRepository;
use App\Repository\FileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sinkido")
 */
class SinkidoController extends AbstractController
{
    /**
     * @Route("/", name="sinkido_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('sinkido/index.html.twig', [
            'articles' => $articleRepository->findBy(['category' => 2])
        ]);
    }
}
