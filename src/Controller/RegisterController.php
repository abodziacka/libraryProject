<?php


namespace App\Controller;


use App\Entity\User;
use App\Repository\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     * @param Request $request1
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function register(Request $request1, UserPasswordEncoderInterface $encoder): Response
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();

        $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
        $user->setRoles(["ROLE_USER"]);

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request1);

        if($form->isSubmitted() && $form->isValid()){
            //Create the user

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_login');
        }


        return $this->render('security/register.html.twig',array(
            'form'=>$form->createView()
        ));

    }
}