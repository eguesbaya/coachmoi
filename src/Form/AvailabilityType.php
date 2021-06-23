<?php

namespace App\Form;

use App\Entity\Weekday;
use App\Entity\Availability;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class AvailabilityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('weekday', EntityType::class, [
                'label' => 'Jour',
                'class' => Weekday::class,
                'choice_label' => 'name',
                'choice_translation_domain' => true
            ])
            ->add('startTime', TimeType::class, [
                'label' => 'Heure de début',
                'widget' => 'single_text',
            ])
            ->add('endTime', TimeType::class, [
                'label' => 'Heure de fin',
                'widget' => 'single_text',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Availability::class,
        ]);
    }
}
