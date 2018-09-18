<?php

namespace App\Form;

use App\Entity\SwimLevels;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SwimLevelsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Swim Level Title: ',
                'label_attr' => [
                    'class' => 'text-warning col-sm-2 col-form-label col-form-label-lg',
                ],
                'attr' => [
                    'class' => 'form-control form-control-lg col-sm-8',
                ]])
            ->add('description', TextareaType::class, [
                'label' => 'Swim Level Description: ',
                'attr' => [
                    'class' => 'form-control form-control-lg',
                ]
            ])
            ->add('requirements', TextareaType::class, [
                'label' => 'Swim Level Requirements: ',
                'attr' => [
                    'class' => 'form-control form-control-lg',
                ]
            ])
            ->add('ageRange', NumberType::class, [
                'label' => 'Age Range: ',
                'attr' => [
                    'class' => 'form-control form-control-lg',
                ]
            ])
            ->add('progression', NumberType::class, [
                'label' => 'Progression: ',
                'attr' => [
                    'class' => 'form-control form-control-lg',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SwimLevels::class,
        ]);
    }
}
