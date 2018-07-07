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
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Media;
use App\Form\MediaType;
use App\Service\FileUploader;


class MediaController extends Controller
{
    /**
     * @Route("/media", name="media")
     */
    public function media(Request $request, FileUploader $fileUploader){

        $media = new Media ;
        dump($media, $request, $fileUploader, $this);

        // Construct° du formulaire.
        $form = $this->createForm(MediaType::class, $media);

        // Capture + traitement de la validat° du formulaire.
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fileName = $fileUploader->upload($media->getAttachment());
            $media->setAttachment($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }


        return $this->render('media/media.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}