<?php

namespace App\Controller;

use App\Entity\File;
use App\Form\FileType;
use App\Repository\FileRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/file")
 */
class AdminFileController extends AbstractController
{
    /**
     * @Route("/", name="admin_file_index", methods={"GET"})
     */
    public function index(FileRepository $fileRepository): Response
    {
        return $this->render('admin_file/index.html.twig', [
            'files' => $fileRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_file_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $file = new File();
        $file->setCreatedAt( new \DateTime());
        $form = $this->createForm(FileType::class, $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // upload file
            $imageFile = $form->get('image')->getData();
            if ($imageFile)
            {
               $imageFilename = $fileUploader->upload($imageFile);
               $file->setimageFilename($imageFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($file);
            $entityManager->flush();

            return $this->redirectToRoute('admin_file_index');
        }

        return $this->render('admin_file/new.html.twig', [
            'file' => $file,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_file_show", methods={"GET"})
     */
    public function show(File $file): Response
    {
        return $this->render('admin_file/show.html.twig', [
            'file' => $file,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_file_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, File $file, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(FileType::class, $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

           // upload file
           $imageFile = $form->get('image')->getData();
           if ($imageFile)
           {
              $imageFilename = $fileUploader->upload($imageFile);
              $file->setimageFilename($imageFilename);
           }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_file_index');
        }

        return $this->render('admin_file/edit.html.twig', [
            'file' => $file,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_file_delete", methods={"POST"})
     */
    public function delete(Request $request, File $file): Response
    {
        if ($this->isCsrfTokenValid('delete'.$file->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($file);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_file_index');
    }
}
