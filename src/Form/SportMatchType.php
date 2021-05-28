<?php

namespace App\Form;

use App\Entity\SportMatch;
use App\Entity\Team;
use App\Entity\Field;
use App\Entity\Tournament;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SportMatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startingAt', DateType::class, [
                'label' => 'Date du match',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('duration', TimeType::class, [
                'label' => 'Durée du match',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('firstTeam', EntityType::class, [
                'label' => 'Equipe 1',
                'class' => Team::class,
                'choice_label' => function (Team $team) {
                    return $team->getName();
                },
                'attr' => ['class' => 'form-control'],
            ])
            ->add('secondTeam', EntityType::class, [
                'label' => 'Equipe 2',
                'class' => Team::class,
                'choice_label' => function (Team $team) {
                    return $team->getName();
                },
                'attr' => ['class' => 'form-control'],
            ])
            ->add('field', EntityType::class, [
                'label' => 'Terrain',
                'class' => Field::class,
                'choice_label' => function (Field $field) {
                    return $field->getName();
                },
                'attr' => ['class' => 'form-control'],
            ])
            ->add('tournament', EntityType::class, [
                'label' => 'Tournois',
                'class' => Tournament::class,
                'choice_label' => function (Tournament $tournament) {
                    return $tournament->getName();
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
            'data_class' => SportMatch::class,
        ]);
    }
}
