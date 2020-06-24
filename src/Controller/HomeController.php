<?php

//********* Autor: Aleksandra Bodziacka **********


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     */
    public function homepage(){
        return $this->render('homepage.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */

    public function contact(){
        return $this->render('contact.html.twig',[
            'text'=> ucwords("Contact")
        ]);
    }

}