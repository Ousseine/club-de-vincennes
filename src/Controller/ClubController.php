<?php

namespace App\Controller;

use App\Form\FileType;
use App\Repository\ArticleRepository;
use App\Repository\FileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/club")
 */
class ClubController extends AbstractController
{
    /**
     * @Route("/", name="club_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('club/index.html.twig', [
            'articles' => $articleRepository->findBy(['category' => 4]),
        ]);
    }
}
