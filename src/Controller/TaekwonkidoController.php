<?php

namespace App\Controller;

use App\Entity\File;
use App\Form\File2Type;
use App\Repository\ArticleRepository;
use App\Repository\FileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/taekwonkido")
 */
class TaekwonkidoController extends AbstractController
{
    /**
     * @Route("/", name="taekwonkido_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('taekwonkido/index.html.twig', [
            'articles' => $articleRepository->findBy(['category' => 1]),
        ]);
    }

}
