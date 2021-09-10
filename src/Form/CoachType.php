<?php

namespace App\Form;

use App\Entity\Coach;
use App\Form\UserType;
use App\Entity\Activity;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class CoachType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', UserType::class, [
                'label' => false,
            ])
            ->add('activities', EntityType::class, [
                'class' => Activity::class,
                'label' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('activity')
                    ->orderBy('activity.name', 'ASC');
                },
                'attr' => ['class' => 'd-flex'],
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false,

            ])
            ->add('birthdate', BirthdayType::class, [
            'label' => 'Date de naissance',
            'widget' => 'single_text',
            'required' => false,
            ])
            ->add('hasVehicle', ChoiceType::class, [
                'label' => 'Possède un véhicule :',
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'expanded' => true ,
                'multiple' => false ,
                'required' => false,
            ])
            ->add('qualification', TextType::class, [
                'label' => 'Qualification :',
                'required' => false,
            ])
            ->add('equipment', TextType::class, [
                'label' => 'Equipement :',
                'required' => false,
            ])
            ->add('biography', TextType::class, [
                'label' => 'Biographie',
                'required' => false,
            ])
            ->add('hourlyRate', IntegerType::class, [
                'label' => 'Taux horaire',
                'required' => false,
            ])
            ->add('photoFile', VichImageType::class, [
                'label' => 'Photo :',
                'delete_label' => 'Supprimer l\'image ?',
                'download_label' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false,
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
