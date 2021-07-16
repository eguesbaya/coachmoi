<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\SearchCoach;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchCoachType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('user', null, [
                'label' => 'Recherche par nom ou prénom',
            ])
            ->add('activity', EntityType::class, [
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
