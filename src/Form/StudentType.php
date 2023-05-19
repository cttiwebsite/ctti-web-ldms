<?php

namespace App\Form;

use App\Entity\Student;
use App\Form\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\CollectionType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('student_id')
            ->add('student_first_name')
            ->add('student_last_name')
            ->add('student_middle_name')
            ->add('student_nrc')
            ->add('student_email')
            ->add('student_program_of_study')
            ->add('student_sponsor')
            ->add('student_gender')
            ->add('student_date_of_birth')
            ->add('student_disability')
            ->add('student_section')
            ->add('submit',SubmitType::class)
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
