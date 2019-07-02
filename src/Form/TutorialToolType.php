<?php

namespace App\Form;

use App\Entity\Tool;
use App\Entity\TutorialTool;
use App\Repository\ToolRepository;
use Sonata\Form\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TutorialToolType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tool', EntityType::class, [
                'class' => Tool::class,
                'choice_label' => 'name',
                'by_reference' => false,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('quantity');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TutorialTool::class,
        ]);
    }
}
