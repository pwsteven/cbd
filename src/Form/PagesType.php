<?php

namespace App\Form;

use App\Entity\Pages;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class PagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pageType', ChoiceType::class, [
                'multiple' => false,
                'choices' => [
                    'Normal Page' => 'Normal',
                    'Orphan Page (Hidden from navigation)' => 'Orphan',
                    'AdWords Page (Hidden from navigation & sitemap)' => 'AdWords',
                ],
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('PageName', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('slug', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('isHomePage', CheckboxType::class, [
                'required' => false,
            ])
            ->add('menuTitle', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => 100,
                ],
            ])
            ->add('seoTitle', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => 100,
                ],
            ])
            ->add('seoDescription', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 5,
                ],
            ])
            ->add('pageContent', HiddenType::class)
            ->add('parent', EntityType::class, [
                'class' => Pages::class,
                'placeholder' => 'Choose an option',
                'attr' => [
                    'class' => 'form-control',
                ],
                'required' => false,
            ])
            ->add('pageOrder', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'choices' => [
                    '0' => 0,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10,
                ]
            ])
            ->add('setLive', CheckboxType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pages::class,
        ]);
    }
}
