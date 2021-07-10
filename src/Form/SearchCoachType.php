<?php

namespace App\Form;

use App\Entity\SearchCoach;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchCoachType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('user', null, [
                'label' => false,
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
