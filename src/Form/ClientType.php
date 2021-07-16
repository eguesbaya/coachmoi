<?php

namespace App\Form;

use App\Entity\Client;
use App\Form\UserType;
use App\Entity\Activity;
use App\Entity\PracticeLevel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', UserType::class, [
                'label' => false,
            ])
            ->add('birthdate', BirthdayType::class, [
            'label' => 'Date de naissance',
            'widget' => 'single_text',
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse'
            ])
            ->add('goal', TextType::class, [
                'label' => 'Objectif sportif'
            ])
            ->add('budget', NumberType::class, [
                'label' => 'Budget (€)'
            ])
            ->add('groupSize', NumberType::class, [
                'label' => 'Nombre de personnes'
            ])
            ->add('isApt', CheckboxType::class, [
                'label' => "Êtes-vous apte à la pratique sportive?",
                'required' => false
            ])

            ->add('practiceLevel', EntityType::class, [
                 'label' => 'Niveau de pratique sportive',
                 'class' => PracticeLevel::class,
                 'choice_label' => 'level'
            ])
            ->add('activity', EntityType::class, [
                'label' => 'Activité',
                'class' => Activity::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
