<?php

namespace App\Form;

use App\Entity\Carte;
use App\Entity\CarteEdition;
use App\Entity\Edition;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarteEditionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rarete')
            ->add('carte', EntityType::class, [
                'class' => Carte::class,
                'choice_label' => 'carte_nom',
            ])
            ->add('edition', EntityType::class, [
                'class' => Edition::class,
                'choice_label' => 'nom_edition',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarteEdition::class,
        ]);
    }
}
