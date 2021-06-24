<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('last_name', TextType::class, [
                'label' => 'Nom :',
                'label_attr' => [
                    'class' => 'h5',
                ],
                'attr' => [
                    'placeholder' => 'Votre nom',
                ]
            ])
            ->add('first_name', TextType::class, [
                'label' => 'Prénom :',
                'label_attr' => [
                    'class' => 'h5',
                ],
                'attr' => [
                    'placeholder' => 'Votre prénom',
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
            ->add('phone', TelType::class, [
                'label' => 'Téléphone :',
                'label_attr' => [
                    'class' => 'h5',
                ],
                'attr' => [
                    'placeholder' => 'Votre téléphone',
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message :',
                'label_attr' => [
                    'class' => 'h5',
                ],
                'attr' => [
                    'placeholder' => 'Votre message',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
