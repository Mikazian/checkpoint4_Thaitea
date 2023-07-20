<?php

namespace App\Form;

use App\Entity\Size;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SizeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('volume', IntegerType::class, [
                'attr' => [
                    'class' => 'w-100 bg-transparent border-1 border-2 border-primary border-start-0 border-top-0 border-end-0 custom-input',
                ],
                'label' => 'Volume (en mL)',
                'label_attr' => [
                    'class' => 'text-tertiary mb-2',
                ]
            ])
            ->add('multiplicator', NumberType::class, [
                'attr' => [
                    'class' => 'w-100 bg-transparent border-1 border-2 border-primary border-start-0 border-top-0 border-end-0 custom-input',
                ],
                'label' => 'Multiplicateur',
                'label_attr' => [
                    'class' => 'text-tertiary mb-2',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Size::class,
        ]);
    }
}
