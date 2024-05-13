<?php

namespace App\Form;

use App\Entity\AvReservation;
use App\Entity\AvStatus;
use App\Entity\AvTrip;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('phone')
            ->add('message')
            ->add('TripId', EntityType::class, [
                "label" => "Voyage",
                'class' => AvTrip::class,
                'choice_label' => 'name',
            ])
            ->add('AvStatus', EntityType::class, [
                "label" => "Status",
                'class' => AvStatus::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AvReservation::class,
        ]);
    }
}
