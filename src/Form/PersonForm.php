<?php

namespace App\Form;

use App\Entity\Dossier;
use App\Entity\Hobby;
use App\Entity\Job;
use App\Entity\Person;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('firstname')
            ->add('age')
            ->add('cin')
            ->add('path')
//            ->add('dossier', EntityType::class, [
//                'class' => Dossier::class,
//                'choice_label' => 'id',
//            ])
            ->add('job', EntityType::class, [
                'class' => Job::class,
            ])
            ->add('hobbies', EntityType::class, [
                'class' => Hobby::class,
                'choice_label' => 'designation',
                'multiple' => true,
            ])
            ->add('ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
