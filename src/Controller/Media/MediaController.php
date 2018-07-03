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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Media;


class MediaController extends Controller
{
    /**
     * @Route("/media", name="media")
     */
    public function media(Request $request){

        $media = new Media ;
        $media->setName('Media test');
        dump($media, $request, $this);

        $form = $this->createFormBuilder($media)
            ->add('name', TextType::class)
            ->add('attachment', FileType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Media'])
            ->getForm();

        return $this->render('media/media.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}