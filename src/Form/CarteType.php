<?php

namespace App\Form;

use App\Entity\Carte;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use PHPUnit\Util\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('carte_nom', TextType::class)
            ->add('carte_categorie', ChoiceType::class, [
                'choices' => [
                    'Monstre' => 'Monstre',
                    'Magie' => 'Magie',
                    'Piège' => 'Piège',
                ],
            ])
            ->add('carte_attribut', ChoiceType::class, [
                'choices' => [
                    'Terre' => 'Terre',
                    'Eau' => 'Eau',
                    'Feu' => 'Feu',
                    'Vent' => 'Vent',
                    'Lumière' => 'Lumière',
                    'Ténèbres' => 'Ténèbres',
                ],
            ])
            ->add('carte_image', TextType::class)
            ->add('carte_type', ChoiceType::class, [
                'choices' => [
                    'Normal' => 'Normal',
                    'Effet' => 'Effet',
                    'Rituel' => 'Rituel',
                    'Fusion' => 'Fusion',
                    'Synchro' => 'Synchro',
                    'XYZ' => 'XYZ',
                    'Link' => 'Link',
                ],
            ])
            ->add('carte_niveau', IntegerType::class)
            ->add('carte_specificite')
            ->add('carte_ATK', IntegerType::class)
            ->add('carte_DEF', IntegerType::class)
            ->add('carte_description', TextType::class);
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Carte::class,
        ]);
    }
}
