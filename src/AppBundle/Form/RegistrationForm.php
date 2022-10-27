<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('middleName')
            ->add('lastName')
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
            ->add('userType', ChoiceType::class, array(
               'choices' => array(
                    'Composer' => 'Composer',
                    'Arranger' => 'Arranger',
                    'Author' => 'Author',
                    'Publisher' => 'Publisher',
                    //'Limited Company Publisher' => 'Limited Company Publisher',
                    'Composer Author Arranger Publisher' => 'Composer Author Arranger Publisher',
                    //'Composer Publisher Arranger' => 'Composer Publisher Arranger',
                    //'Publisher Author Arranger' => 'Publisher Author Arranger',
                    //'Composer Publisher' => 'Composer Publisher'
                    //.'Co Author' => 'Co Author',
                    //'Deceased Composer' => 'Deceased Composer',
                   // 'Deceased Arranger' => 'Deceased Arranger',
                    //'Deceased Author' => 'Deceased Author',
                  //  'Sub Publisher' => 'Sub Publisher',
                    //'Sole Proprietorship Publisher' => 'Sole Proprietorship Publisher',
                    //'Limited Company Publisher' => 'Limited Company Publisher'
                ),
                'placeholder'=>'Select',
                'label'=>'Account Type'
            ))
            ->add('producerRelationship', ChoiceType::class, array(
                'choices' => array(
                    'Wife' => 'Wife',
                    'Husband'=>'Husband',
                    'Mother' => 'Mother',
                    'Brother' => 'Brother',
                    'Sister' => 'Sister',
                    'Son'=>'Son',
                    'Daughter'=>'Daughter'
                ),
                'placeholder'=>'Select',
                'label'=>false,
                'required'=>false
            ))
            ->add('email',RepeatedType::class,[
                'type' => EmailType::class
            ])
            ->add('plainPassword',RepeatedType::class,[
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'attr'=>['class'=>'form-control'],
            ])
            ->add('phoneNumber',null,[
                'attr'=>[
                    'placeholder'=>'254700776144'
                    ]
            ])
            ->add('isTermsAccepted');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\User'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_registration_form';
    }
}
