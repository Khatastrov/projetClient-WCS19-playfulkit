<?php

namespace App\Form;

use App\Entity\Tool;
use App\Entity\TutorialTool;
use App\Repository\ToolRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TutorialToolType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', null)
            ->add('name', EntityType::class, [
                'class' => Tool::class,
                'query_builder' => function (ToolRepository $toolRepository) {
                    return $toolRepository->getNameByCategory("handtool");
                },
                'choice_label' => 'category',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TutorialTool::class,
        ]);
    }
}
