<?php


namespace App\Admin;

use App\Entity\Category;
use App\Entity\Tool;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use Symfony\Component\Validator\Constraints\File;

class LessonAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', TextType::class);
        $formMapper->add('imageFile', FileType::class, [
            'required'=> false,
            'label' => 'Illustration',
            'attr' => [
                'class' => 'champImg',
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
        ]);
        $formMapper->add('category', ModelType::class, [
            'class' => Category::class,
            'property' => 'name',
        ]);
        $formMapper->add('tool', ModelType::class, [
            'class' => Tool::class,
            'property' => 'name',
            'multiple' => true
        ]);
        $formMapper->add('content', SimpleFormatterType::class, [
                'format' => 'text',
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title');
    }
}
