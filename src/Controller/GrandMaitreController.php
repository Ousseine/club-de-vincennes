<?php

namespace App\Controller;

use App\Entity\File;
use App\Form\File3Type;
use App\Repository\ArticleRepository;
use App\Repository\FileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/grand/maitre")
 */
class GrandMaitreController extends AbstractController
{
    /**
     * @Route("/", name="grand_maitre_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('grand_maitre/index.html.twig', [
            'articles' => $articleRepository->findBy(['category' => 5]),
        ]);
    }
}
