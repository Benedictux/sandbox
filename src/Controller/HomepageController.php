<?php
/**
 * Created by BChar
 * Date: 03/07/2018
 * Time: 22:47
 */
namespace App\Controller;


// ------------------------------------------------------------------------------------------------------------------ //
// Imports.                                                                                                           //
// ------------------------------------------------------------------------------------------------------------------ //
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(){

        return $this->render('default/homepage.html.twig', [
        ]);
    }
}