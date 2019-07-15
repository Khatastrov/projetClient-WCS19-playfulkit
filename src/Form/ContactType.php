<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBunle\Form\Type\CaptchaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, [
                'required'   => false,
                'label' => 'Ton nom :',
                'attr' => [
                    'placeholder' => 'Entre ton nom de famille'
                ]
            ])
            ->add('prenom', null, [
                'required'   => false,
                'label' => 'Ton prénom :',
                'attr' => [
                    'placeholder' => 'Entre ton prénom'
                ]
            ])
            ->add('email', null, [
                'label' => 'Ton adresse email : *',
                'attr' => [
                    'placeholder' => 'adresse@mail.fr'
                ]
            ])
            ->add('message', null, [
                'label' => 'Ton message : *',
                'attr' => [
                    'placeholder' => 'Écris ici ton message...'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
