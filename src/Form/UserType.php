<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Ton pseudo :',
            ])
            ->add('email', TextType::class, [
                'label' => 'Ton adresse email :'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Ton prénom :',
                'required' => false,
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Ton nom :',
                'required' => false,
            ])
            ->add('address', TextType::class, [
                'label' => 'Ton adresse :',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
