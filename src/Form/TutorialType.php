<?php
namespace App\Form;

use App\Entity\Tutorial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\File;

class TutorialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'label' => 'Commence par donner un titre à ton tuto :'
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
            ->add('is_published', ChoiceType::class, [
            'choices' => [
                'Oui' => true,
                'Non' => false,
                ],
            ])
            ->add('choix', ChoiceType::class, [
                'label' => 'Choisis le type d\'illustration que tu veux ajouter :',
                'mapped' => false,
                'choices' => [
                    'Une photo' => null,
                    'Une vidéo' => null,
                    'Pas d\'illustration' => null,
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('illustration', null, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'class' => 'champVid',
                    'style' => 'display: none;',
                    'placeholder' => 'Colle ici le lien vers ta vidéo Youtube !'
                ]
                ])
            ->add('imageFile', FileType::class, [
                'required'=> false,
                'label' => false,
                'attr' => [
                    'class' => 'champImg',
                    'placeholder' => 'Ajoute ta photo ! (elle ne doit pas dépasser 2Mo)',
                ],
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Enregistre une image au format jpeg ou png',
                    ])
                ]
            ])
            ->add('tools', CollectionType::class, [
                'label' => false,
                'entry_type' => TutorialToolType::class,
                'required' => false,
                'entry_options' => ['label' => false],
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tutorial::class,
        ]);
    }
}
