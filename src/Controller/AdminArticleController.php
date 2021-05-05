<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Service\FileUploader;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

/**
 * @Route("/admin/article")
 */
class AdminArticleController extends AbstractController
{
    /**
     * @Route("/", name="admin_article_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('admin_article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_article_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $article = new Article();
        $article->setCreatedAt(new \DateTime());
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // upload file
            $imageFile = $form->get('file')->getData();
            if ($imageFile)
            {
               $file = $fileUploader->upload($imageFile);
               $article->setFile($file);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('admin_article_index');
        }

        return $this->render('admin_article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('admin_article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article, FileUploader $fileUploader, CacheManager $cacheManager,
                         UploaderHelper $helper):
    Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($article->getFile() instanceof UploadedFile)
            {
               $cacheManager->remove($helper->asset($article, 'file'));

               $cacheManager->remove();
            }

            // upload file
            $imageFile = $form->get('file')->getData();
            if ($imageFile)
            {
               $file = $fileUploader->upload($imageFile);
               $article->setFile($file);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_article_index');
        }

        return $this->render('admin_article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_article_delete", methods={"POST"})
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_article_index');
    }
}
