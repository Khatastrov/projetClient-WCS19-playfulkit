<?php


namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserSignUpType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nickname',TextType::class, [
                'attr' => ['placeholder' => 'jean59'],
                'constraints' => [new NotBlank(["message" => "Veuillez rentrer un pseudo "]),]
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'exemple@mail.fr'],
                'constraints' => [new NotBlank(["message" => "Veuillez indiquer votre adresse mail"]),]
            ])
            ->add('password', RepeatedType::class, [
                'constraints' => [new NotBlank(["message" => 'Veuillez entrer un mot de passe']),],
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe ne correspond pas',
                'options' => ['attr' => ['placeholder' => 'votre mot de passe']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('birth_date', BirthdayType::class,[
                'placeholder' => ['year' => 'année', 'month' => 'mois','day' => 'jour',]

            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
