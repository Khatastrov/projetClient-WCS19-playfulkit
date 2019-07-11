<?php

namespace App\Form;

use App\Entity\Tool;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TutorialToolType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Le nom de ton outil',
            ])
            ->add('quantity', null, [
                'label'=> 'La quantité',
            ])
            ->add('category', ChoiceType::class, [
                'label' => 'Choisie la catégorie de ton outil',
                'choices' => [
                    'Logiciel' => 'software',
                    'Outil' => 'handtool',
                    'Composant' => 'hardware',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tool::class,
        ]);
    }
}
