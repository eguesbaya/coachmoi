<?php

namespace App\Form;

use App\Entity\Coach;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CoachType extends AbstractType
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
            ->add('hasVehicle', CheckboxType::class, [
                'label' => "Possède un véhicule :"
            ])
            ->add('qualification', TextType::class, [
                'label' => 'Qualitification :'
            ])
            ->add('equipment', TextType::class, [
                'label' => 'Equipement :'
            ])
            ->add('biography', TextType::class, [
                'label' => 'Biographie'
            ])
            ->add('hourlyRate', IntegerType::class, [
                'label' => 'Taux horaire    '
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Coach::class,
        ]);
    }
}
