<?php

namespace App\Form;

use App\Entity\TutorialStep;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TutorialStepType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'label' => 'Donne un titre à ton étape'
            ])
            ->add('content', null, [
                'label' => 'Ensuite, décris ton étape'
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Tu peux aussi ajouter une image (optionnel)',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TutorialStep::class,
        ]);
    }
}
