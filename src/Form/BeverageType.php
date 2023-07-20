<?php

namespace App\Form;

use App\Entity\Beverage;
use App\Entity\Ingredient;
use App\Form\AromaAutocompleteField;
use App\Form\LiquidAutocompleteField;
use App\Form\CreatorAutocompleteField;
use Symfony\Component\Form\AbstractType;
use App\Form\IngredientAutocompleteField;
use Vich\UploaderBundle\Form\Type\VichFileType;
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
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'allow_delete'  => true,
                'delete_label' => 'Supprimer l\'image',
                'download_uri' => true,
                'attr' => [
                    'class' => 'mt-4',
                ],
                'label_attr' => [
                    'class' => 'd-none',
                ],
            ])
            ->add('is_new', CheckboxType::class, [
                'label' => 'Nouveauté ?',
                'required' => false,
            ])
            ->add('creator', CreatorAutocompleteField::class)
            ->add('liquid', LiquidAutocompleteField::class)
            ->add('aroma', AromaAutocompleteField::class)
            ->add('bubble', BubbleAutocompleteField::class)
            ->add('ingredient', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true,
                'autocomplete' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Beverage::class,
        ]);
    }
}
