<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewAdministratorForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('accountExpiresAt', DateTimeType::class, [
                'placeholder' => 'Select a value',
                'format' => 'yyyy-MM-dd h:i:s',
            ])
            ->add('region', ChoiceType::class, array(
                'choices' => array(
                    'Nairobi' => 'Nairobi',
                    'Coast' => 'Coast',
                    'Central' => 'Central',
                    'Rift Valley' => 'Rift Valley',
                    'Nyanza' => 'Nyanza',
                    'Eastern' => 'Eastern',
                    'Western' => 'Western',
                ),
                'placeholder'=>'Select'
            ))
            ->add('imageFile', FileType::class, [
                'mapped' => false,
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\User'
        ]);
    }


    public function getBlockPrefix()
    {
        return 'app_bundle_new_administrator_form';
    }
}
