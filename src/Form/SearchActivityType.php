<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\SearchCoach;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('activity', EntityType::class, [
                'placeholder' => 'Toutes les activités',
                'label' => 'Recherche par activité',
                'class' => Activity::class,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchCoach::class,
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return parent::getBlockPrefix();
    }
}
