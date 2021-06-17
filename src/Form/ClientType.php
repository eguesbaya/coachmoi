<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Activity;
use App\Entity\PracticeLevel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('birthdate', BirthdayType::class, [
                'widget' => 'single_text',
            ])
            ->add('address', TextType::class)
            ->add('goal', TextType::class)
            ->add('budget', MoneyType::class)
            ->add('groupSize', NumberType::class)
            ->add('isApt', CheckboxType::class)
            ->add('activity', EntityType::class, [
                'class' => Activity::class,
                'choice_label' => 'name',
            ])
            ->add('practiceLevel', EntityType::class, [
                'class' => PracticeLevel::class,
                'choice_label' => 'level',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
