<?php

namespace App\Form;

use App\Entity\TrainingSpace;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TrainingSpaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom de l'espace"
            ])
            ->add('address', TextType::class, [
                'label' => "Adresse"
            ])
            ->add('spaceCategory', null, [
                'label' => "Type de l'espace",
                'choice_label' => 'name'
            ])
            ->add('activity', null, [
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => true,
            ])
            ->add('photoFile', VichImageType::class, [
                'label' => 'Image :',
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
            'data_class' => TrainingSpace::class,
        ]);
    }
}
