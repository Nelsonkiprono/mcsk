<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfirmCorporateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mpesaConfirmationCode',null,[
                'attr'=>[
                    'placeholder'=>'MIA0KH0NPU',
                    'class'=>'md-input'
                ]
            ])
            ->add('mpesaAmount',IntegerType::class,[
                'attr'=>[
                    'placeholder'=>'3000',
                    'class'=>'md-input'

                ]
            ])
            ->add('mpesaPaymentDate',null,[
                'attr'=>[
                    'placeholder'=>'04-09-18 10.09 AM',
                    'class'=>'md-select'
                    ]
            ])
            ->add('mpesaNumber',null,[
                'attr'=>[
                    'placeholder'=>'254700776144',
                    'class'=>'md-input'
                    ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'AppBundle\Entity\CorporateProfile'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_confirm_mpesa_form';
    }
}