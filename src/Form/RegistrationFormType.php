<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

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
                'row_attr' => [
                    'class' => 'my-3',
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom :',
                'label_attr' => [
                    'class' => 'h5',
                ],
                'row_attr' => [
                    'class' => 'my-3',
                ]
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Téléphone :',
                'label_attr' => [
                    'class' => 'h5',
                ],
                'row_attr' => [
                    'class' => 'my-3',
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail :',
                'label_attr' => [
                    'class' => 'h5',
                ],
                'row_attr' => [
                    'class' => 'my-3',
                ]
            ])
            ->add('registrationRole', ChoiceType::class, [
                'label' => false,
                'choices' => [
                    'Je souhaite m\'inscrire en tant que coach' => 'ROLE_COACH',
                    'Je souhaite m\'inscrire en tant qu\'adhérent' => 'ROLE_CLIENT',
                ],
                'multiple' => false,
                'expanded' => true,
                'placeholder' => false,
                'required' => false,
                'mapped' => false,
                'row_attr' => [
                    'class' => 'my-3',
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez accepter les conditions d\'utilisation',
                    ]),
                ],
                'row_attr' => [
                    'class' => 'my-3',
                ]
            ])

            ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe :',
                'label_attr' => [
                    'class' => 'h5',
                ],
                'mapped' => false,
                'row_attr' => [
                    'class' => 'my-3',
                ],
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez indiquer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
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
