<?php

namespace App\Form;

use App\Entity\Dossier;
use App\Entity\Hobby;
use App\Entity\Job;
use App\Entity\Person;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PersonForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('firstname')
            ->add('age')
            ->add('cin')
            ->add('file',
                FileType::class, [
                    'mapped' => false,
                    // make it optional so you don't have to re-upload the PDF file
                    // every time you edit the Product details
                    'required' => false,

                    // unmapped fields can't define their validation using attributes
                    // in the associated entity, so you can use the PHP constraint classes
                    'constraints' => [
                        new File([
                            'maxSize' => '1024k',
                            'extensions' => ['jpg','jpeg','png'],
                            'extensionsMessage' => "Please upload a valid Image file('jpg','jpeg','png')",
                        ])
                    ],
                ])
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
            ->add('ajouter', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
