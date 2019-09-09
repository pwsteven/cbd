<?php

namespace App\Form;

use App\Entity\Pages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditPageType extends AbstractType
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
            ->add('setLive', CheckboxType::class, [
                'required' => false,
            ])

            ->add('parent')
            ->add('pageOrder')

            ->add('dateAdded', HiddenType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pages::class,
        ]);
    }
}
