<?php

namespace App\Form;

use App\Entity\Tournament;
use App\Entity\Place;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TournamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'form-control'],
            ])

            ->add('sport', TextType::class, [
                'label' => 'Sport',
                'attr' => ['class' => 'form-control'],
            ])

            ->add('teamsNumber', NumberType::class, [
                'label' => 'Nombre d\'équipe',
                'attr' => ['class' => 'form-control'],
            ])

            ->add('maxPlayersPerTeamNumber', NumberType::class, [
                'label' => 'Nombre maximum de jours par équipe',
                'attr' => ['class' => 'form-control'],
            ])

            ->add('startingAt', DateType::class, [
                'label' => 'Date du tournois',
                'attr' => ['class' => 'form-control'],
            ])

            ->add('place', EntityType::class, [
                'label' => 'Lieu',
                'class' => Place::class,
                'choice_label' => function (Place $place) {
                    return '(' . $place->getPostcode() . ') ' . $place->getTown() . ' - ' . $place->getStreet() . ', ' . $place->getCountry();
                },
                'attr' => ['class' => 'form-control'],


            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn btn-primary'],
            ])

            
        ;
    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tournament::class,
        ]);
    }
}
