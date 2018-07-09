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


        return $this->render('media/media.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}