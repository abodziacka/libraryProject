<?php

//********* Autor: Marta Brzozowska **********
namespace App\Controller;


use http\Env\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SuccessController extends AbstractController
{
    /**
     * @Route("/success", name="app_success")
     */
     public function success() : \Symfony\Component\HttpFoundation\Response
     {

         return $this->render('security/success.html.twig');
     }

}