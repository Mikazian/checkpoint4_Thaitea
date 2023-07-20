<?php

namespace App\Form;

use App\Entity\Beverage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BeverageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('image')
            ->add('is_new')
            ->add('creator')
            ->add('liquid')
            ->add('aroma')
            ->add('bubble')
            ->add('ingredient')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Beverage::class,
        ]);
    }
}
