<?php

namespace App\Form;

use App\Entity\Tutorial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TutorialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre de ton tutoriel :'
            ])
            ->add('content', null, [
                'label' => 'Ajoute une courte description :'
            ])
            ->add('steps', CollectionType::class, [
                'label' => false,
                'entry_type' => TutorialStepType::class,
                'required' => false,
                'entry_options' => ['label' => false],
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->add('choix', ChoiceType::class, [
                'label' => 'Choisis le type d\'illustration que tu veux ajouter :',
                'mapped' => false,
                'choices' => [
                    'Aucune illustration' => null,
                    'Une vidéo' => null,
                    'Une photo' => null,
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('video', null, [
                'label' => 'Copie le lien vers ta vidéo Youtube :'
                ])
            ->add('imageFile', FileType::class, ['required'=> false])
            ->add('illustration', null, [
                'label' => 'Copie le lien vers ta photo :'
            ])
            ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tutorial::class,
        ]);
    }
}
