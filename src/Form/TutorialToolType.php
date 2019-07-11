<?php

namespace App\Form;

use App\Entity\TutorialTool;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TutorialToolType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('quantity')
            ->add('category', ChoiceType::class, [
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
            'data_class' => TutorialTool::class,
        ]);
    }
}
