<?php

namespace App\Form;

use App\Entity\InterestedPeople;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class InterestedPeopleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', null, [
                'label' => 'Je veux faire partie des premiers inscrits :',
                'constraints' => [
                    new NotBlank([
                        "message" => 'Tu dois entrer une adresse email'
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'exemple@mail.com',
                ],
            ])
            ->add('inscription', SubmitType::class, [
                'label' => 'Je m\'inscris !',
                'attr' => [
                    'class' => 'btn btnLogin'
                ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InterestedPeople::class,
        ]);
    }
}
