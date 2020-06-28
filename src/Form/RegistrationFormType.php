<?php

//********* Autor: Aleksandra Bodziacka + Marta Brzozowska (style) **********

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class,[
                'attr' => ['class'=> 'form-control',
                    'style'=>'padding-bottom: 10px; margin-bottom: 10px;',
                ]])
            ->add('surname', TextType::class,[
                'attr' => ['class'=> 'form-control',
                    'style'=>'padding-bottom: 10px; margin-bottom: 10px;',
                ]])
            ->add('email', EmailType::class,[
                'attr' => ['class'=> 'form-control',
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
        ;
//
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
