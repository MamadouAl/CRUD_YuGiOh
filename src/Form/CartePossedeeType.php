<?php

namespace App\Form;

use App\Entity\Carte;
use App\Entity\CartePossedee;
use App\Entity\Edition;
use App\Entity\Langue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartePossedeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite')
            ->add('carte', EntityType::class, [
                'class' => Carte::class,
'choice_label' => 'getCarteNom',
            ])
            ->add('edition', EntityType::class, [
                'class' => Edition::class,
'choice_label' => 'getNomEdition',
            ])
            ->add('langue', EntityType::class, [
                'class' => Langue::class,
'choice_label' => 'getNomLangue',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CartePossedee::class,
        ]);
    }
}
