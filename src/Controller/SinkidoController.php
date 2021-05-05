<?php

namespace App\Controller;

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
    public function index(FileRepository $fileRepository): Response
    {
        return $this->render('sinkido/index.html.twig', [
            'files' => $fileRepository->findAll(),
        ]);
    }
}
