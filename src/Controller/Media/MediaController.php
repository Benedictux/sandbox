<?php
/**
 * Created by BChar
 * Date: 03/07/2018
 * Time: 23:40
 */
namespace App\Controller\Media;

// ------------------------------------------------------------------------------------------------------------------ //
// Imports.                                                                                                           //
// ------------------------------------------------------------------------------------------------------------------ //
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Media;
use App\Form\MediaType;
use App\Form\MediaEditType;
use App\Repository\MediaRepository;
use App\Service\FileUploader;


/**
 * @Route("/media")
 */
class MediaController extends AbstractController
{
    /**
     * @Route("/index", name="media_index")
     */
    public function index(MediaRepository $mediasRep){
        $medias = $mediasRep->findAll();
        return $this->render('media/index.html.twig', [
            'medias' => $medias,
        ]);
    }


    /**
     * @Route("/show/{id}", name="media_show")
     */
    public function show(Media $media){
        return $this->render('media/show.html.twig', [
            'media' => $media,
        ]);
    }


    /**
     * @Route("/upload", name="media_upload")
     */
    public function upload(Request $request, FileUploader $fileUploader){

        $media = new Media ;

        // Construct° du formulaire.
        $form = $this->createForm(MediaType::class, $media);

        // Capture + traitement de la validat° du formulaire.
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fileName = $fileUploader->upload($media->getAttachment());
            $fileUploader->makeThumbnails($fileName);

            $media->setAttachment($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $em->flush();
            return $this->redirectToRoute('media_index');
        }

        return $this->render('media/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="media_delete")
     */
    public function delete(Media $media, FileUploader $fileUploader){

        $fileUploader->delete($media->getAttachment());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($media);
        $entityManager->flush();
    }

    /**
     * @Route("/edit/{id}", name="media_update")
     */
    public function edit(Request $request, Media $media){

        // Construct° du formulaire.
        $form = $this->createForm(MediaEditType::class, $media);
        $form = $form->remove('attachement');

        // Capture + traitement de la validat° du formulaire.
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('media_index');
        }

        return $this->render('media/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}