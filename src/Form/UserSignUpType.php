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
use Symfony\Component\Validator\Constraints\Length;
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
            ->add('username', TextType::class, [
                'attr' => ['placeholder' => 'jean59'],
                'constraints' => [new NotBlank(["message" => "Tu dois choisir un pseudo"]),]
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'exemple@mail.fr'],
                'constraints' => [new NotBlank(["message" => "Tu n'as pas renseigné ton adresse mail "]),]
            ])
            ->add('password', RepeatedType::class, [
                'constraints' => [
                    new NotBlank([
                        "message" => 'Tu dois entrer un mot de passe'
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'ton mot de passe doit contenir plus de {{ limit }} caractères',
                        'max' => 4096,
                    ])
                    ],
                'type' => PasswordType::class,
                'invalid_message' => 'Les mot de passes ne correspondent pas',
                'options' => ['attr' => ['placeholder' => 'Ton mot de passe']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('birth_date', BirthdayType::class, [
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
