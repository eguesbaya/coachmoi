<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom :',
                'label_attr' => [
                    'class' => 'h5',
                ],
                'attr' => [
                    'placeholder' => 'Votre prénom',
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom :',
                'label_attr' => [
                    'class' => 'h5',
                ],
                'attr' => [
                    'placeholder' => 'Votre nom',
                ]
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Téléphone :',
                'label_attr' => [
                    'class' => 'h5',
                ],
                'attr' => [
                    'placeholder' => 'Téléphone',
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail :',
                'label_attr' => [
                    'class' => 'h5',
                ],
                'attr' => [
                    'placeholder' => 'Votre e-mail',
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe :',
                'label_attr' => [
                    'class' => 'h5',
                ],
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Votre mot de passe'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
