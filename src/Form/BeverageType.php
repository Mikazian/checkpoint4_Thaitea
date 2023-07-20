<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Aroma;
use App\Entity\Bubble;
use App\Entity\Liquid;
use App\Entity\Beverage;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class BeverageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'w-100 bg-transparent border-1 border-2 border-primary border-start-0 border-top-0 border-end-0 custom-input',
                ],
            ])
            ->add('price', NumberType::class, [
                'attr' => [
                    'class' => 'w-100 bg-transparent border-1 border-2 border-primary border-start-0 border-top-0 border-end-0 custom-input',
                ],
            ])
            ->add('image', TextType::class, [
                'required' => false,
            ])
            ->add('is_new', CheckboxType::class, [
                'label' => 'Nouveauté ?',
                'required' => false,
            ])
            ->add('creator', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
                'by_reference' => true,
            ])
            ->add('liquid', EntityType::class, [
                'class' => Liquid::class,
                'choice_label' => 'name',
                'by_reference' => true,
            ])
            ->add('aroma', EntityType::class, [
                'class' => Aroma::class,
                'choice_label' => 'name',
                'by_reference' => true,
            ])
            ->add('bubble', EntityType::class, [
                'class' => Bubble::class,
                'choice_label' => 'name',
                'by_reference' => true,
            ])
            ->add('ingredient', CollectionType::class, [
                'entry_type' => EntityType::class,
                'entry_options' => [
                    'class' => Ingredient::class,
                    'choice_label' => 'name',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Beverage::class,
        ]);
    }
}
