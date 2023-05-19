<?php

namespace App\Form;

use App\Entity\Staff;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StaffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('staff_id')
            ->add('staff_first_name')
            ->add('staff_middle_name')
            ->add('staff_last_name')
            ->add('staff_email')
            ->add('staff_nrc')
            ->add('staff_designation')
            ->add('staff_contact')
            ->add('staff_faculty')
            ->add('staff_program')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Staff::class,
        ]);
    }
}
