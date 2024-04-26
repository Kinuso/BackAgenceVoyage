<?php

namespace App\Form;

use App\Entity\AvCategory;
use App\Entity\AvCountry;
use App\Entity\AvTrip;
use App\Entity\AvUser;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvTripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('picture')
            ->add('description')
            ->add('price')
            ->add('start', null, [
                'widget' => 'single_text'
            ])
            ->add('finish', null, [
                'widget' => 'single_text'
            ])
            ->add('AvUser', EntityType::class, [
                'class' => AvUser::class,
'choice_label' => 'id',
            ])
            ->add('AvCategory', EntityType::class, [
                'class' => AvCategory::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('AvCountry', EntityType::class, [
                'class' => AvCountry::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AvTrip::class,
        ]);
    }
}
