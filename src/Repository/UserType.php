<?php

//********* Autor: Marta Brzozowska **********
namespace App\Repository;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('email', TextType::class,[
               'attr' => ['class'=> 'form-control',
                   'type'=>'email',
                   'style'=>'padding-bottom: 10px; margin-bottom: 10px;',


               ]])
           ->add('plainPassword', RepeatedType::class, array(
               'type' => PasswordType::class,
               'invalid_message' => 'The password fields must match.',
               'options' => ['attr' => ['class' => 'form-control','style'=>' padding-bottom: 10px; margin-bottom: 10px;']],
               'required' => true,
               'first_options'  => array('label' => 'Password'),
               'second_options' => array('label' => 'Repeat Password'),
           ))
           ->add('Create',SubmitType::class,[
               'attr' =>[
                   'class' => 'btn btn-success pull-right',
                   'name'=>'Create',

               ]

    ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
