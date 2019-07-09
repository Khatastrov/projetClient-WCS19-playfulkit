<?php

namespace App\Form;

use App\Entity\Tool;
use App\Entity\TutorialTool;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TutorialToolType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity')
            ->add('tool', EntityType::class, [
                'class' => Tool::class,
                'choice_label' => 'name',
                'by_reference' => false,
                'multiple' => false,
                'expanded' => false,
                'label' => 'Le nom de ton outil',
            ]);

            /*
            ->add('tools', CollectionType::class, [
                'entry_type' => ToolType::class,
                'entry_options' => [
                    'label' => false
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ]);
            */
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TutorialTool::class,
        ]);
    }
}
