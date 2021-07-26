<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                       'message' => 'Merci de saisir une address email'
                    ])
                    ],
                    'required' => true,
                    'attr' => [
                        'class' => 'form-control'
                    ]
            ])

            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Client' => 'ROLE_CLIENT',
                    'Coach' => 'ROLE_COACH',
                    'SuperAdmin' => 'ROLE_SUPERADMIN',
                ],
                'expanded' => true,
                'mapped' => false,
                'multiple' => false,
                'data' => $builder->getData()->getRoles()[0]
            ])
            ->add('Valider', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
