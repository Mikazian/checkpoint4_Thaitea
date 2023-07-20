<?php

namespace App\Form;

use App\Entity\Bubble;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BubbleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'w-100 bg-transparent border-1 border-2 border-primary border-start-0 border-top-0 border-end-0 custom-input',
                ],
                'label' => 'Nom du bubble',
                'label_attr' => [
                    'class' => 'text-tertiary mb-2',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bubble::class,
        ]);
    }
}
