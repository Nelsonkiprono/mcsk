<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\User;

class ApplicantDetailsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isGroup', ChoiceType::class, array(
                'choices' => array(
		    'No' => 'false',
                    'Yes' => 'true',
                ),
                'data' => 'No'
            ))
            ->add('firstGroupMemberPosition', ChoiceType::class, array(
                'choices' => array(
                    'Member' => 'Member',
                    'Representative' => 'Representative',
                ),
                'data' => 'Member',
                'placeholder'=>'Select'
            ))
            ->add('firstGroupMemberFname')
            ->add('firstGroupMemberSname')
            ->add('firstGroupMemberLname')
            ->add('firstGroupMemberId')
            ->add('firstGroupMemberPhone')
            ->add('firstGroupMemberEmail')

            ->add('secondGroupMemberPosition', ChoiceType::class, array(
                'choices' => array(
                    'Member' => 'Member',
                    'Representative' => 'Representative',
                ),
                'data' => 'Member',
                'placeholder'=>'Select'
            ))
            ->add('secondGroupMemberFname')
            ->add('secondGroupMemberSname')
            ->add('secondGroupMemberLname')
            ->add('secondGroupMemberId')
            ->add('secondGroupMemberPhone')
            ->add('secondGroupMemberEmail')

            ->add('thirdGroupMemberPosition', ChoiceType::class, array(
                'choices' => array(
                    'Member' => 'Member',
                    'Representative' => 'Representative',
                ),
                'data' => 'Member',
                'placeholder'=>'Select'
            ))
            ->add('thirdGroupMemberFname')
            ->add('thirdGroupMemberSname')
            ->add('thirdGroupMemberLname')
            ->add('thirdGroupMemberId')
            ->add('thirdGroupMemberPhone')
            ->add('thirdGroupMemberEmail')

            ->add('fourthGroupMemberPosition', ChoiceType::class, array(
                'choices' => array(
                    'Member' => 'Member',
                    'Representative' => 'Representative',
                ),
                'data' => 'Member',
                'placeholder'=>'Select'
            ))
            ->add('fourthGroupMemberFname')
            ->add('fourthGroupMemberSname')
            ->add('fourthGroupMemberLname')
            ->add('fourthGroupMemberId')
            ->add('fourthGroupMemberPhone')
            ->add('fourthGroupMemberEmail')

            ->add('fifthGroupMemberPosition', ChoiceType::class, array(
                'choices' => array(
                    'Member' => 'Member',
                    'Representative' => 'Representative',
                ),
                'data' => 'Member',
                'placeholder'=>'Select'
            ))
            ->add('fifthGroupMemberFname')
            ->add('fifthGroupMemberSname')
            ->add('fifthGroupMemberLname')
            ->add('fifthGroupMemberId')
            ->add('fifthGroupMemberPhone')
            ->add('fifthGroupMemberEmail')

            ->add('sixthGroupMemberPosition', ChoiceType::class, array(
                'choices' => array(
                    'Member' => 'Member',
                    'Representative' => 'Representative',
                ),
                'data' => 'Member',
                'placeholder'=>'Select'
            ))
            ->add('sixthGroupMemberFname')
            ->add('sixthGroupMemberSname')
            ->add('sixthGroupMemberLname')
            ->add('sixthGroupMemberId')
            ->add('sixthGroupMemberPhone')
            ->add('sixthGroupMemberEmail')

            ->add('pseudonym')
            ->add('nationality')

            ->add('prefferedRegion', ChoiceType::class, array(
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
            ->add('applicantName')

            ->add('idNumber')
            ->add('itaxPin',null,[
                'required'=>true
            ])
            ->add('dateOfBirth',DateType::class,[
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
                'html5' => false,
            ])
            ->add('gender',ChoiceType::class,array(
                'choices'=>array(
                    'Male'=>'Male',
                    'Female'=>'Female',
                ),
                'data' => 'Male',
                'multiple'=>false,
                'expanded'=>true,
                'required' => true
            ))
            ->add('maritalStatus',ChoiceType::class,array(
                'choices'=>array(
                    'Single'=>'Single',
                    'Married'=>'Married',
                ),
                'data' => 'Single',
                'multiple'=>false,
                'expanded'=>true,
                'required' => true
            ))
            ->add('physicalAddress',null,[
                'required'=>true

            ])
            ->add('city',null,[
                'required'=>true
            ])

            ->add('county', ChoiceType::class, array(
                'choices' => array(
                    'Nairobi' => 'Nairobi',
                    'Mombasa' => 'Mombasa',
                    'Kisumu' => 'Kisumu',
                    'Muranga' => 'Muranga',
                    'Nakuru' => 'Nakuru',
                    'Nyeri' => 'Nyeri',
                    'Machakos' => 'Machakos',
                    'Bungoma' => 'Bungoma',
                    'Busia' => 'Busia',
                    'Elgeyo Marakwet' => 'Elgeyo Marakwet',
                    'Embu' => 'Embu',
                    'Garrisa' => 'Garrisa',
                    'Homa Bay' => 'Homa Bay',
                    'Isiolo' => 'Isiolo',
                    'Kajiado' => 'Kajiado',
                    'Kakamega' => 'Kakamega',
                    'Kericho' => 'Kericho',
                    'Kiambu' => 'Kiambu',
                    'Kilifi' => 'Kilifi',
                    'Kirinyaga' => 'Kirinyaga',
                    'Kisii' => 'Kisii',
                    'Kitui' => 'Kitui',
                    'Kwale' => 'Kwale',
                    'Laikipia' => 'Laikipia',
                    'Lamu' => 'Lamu',
                    'Makueni' => 'Makueni',
                    'Mandera' => 'Mandera',
                    'Marsabit' => 'Marsabit',
                    'Meru' => 'Meru',
                    'Migori' => 'Migori',
                    'Nandi' => 'Nandi',
                    'Narok' => 'Narok',
                    'Nyamira' => 'Nyamira',
                    'Nyandarua' => 'Nyandarua',
                    'Samburu' => 'Samburu',
                    'Siaya' => 'Siaya',
                    'Taita Taveta' => 'Taita Taveta',
                    'Tana River' => 'Tana River',
                    'Tharaka Nithi' => 'Tharaka Nithi',
                    'Trans Nzoia' => 'Trans Nzoia',
                    'Turkana' => 'Turkana',
                    'Uasin Gishu' => 'Uasin Gishu',
                    'Vihiga' => 'Vihiga',
                    'Wajir' => 'Wajir',
                    'West Pokot' => 'West Pokot',
                ),
                'placeholder'=>'Select'
            ))
            ->add('postalAddress')
            ->add('postalCode')
            ->add('telephoneNumber')
            ->add('mobileNumber',null,[
                'attr'=>['placeholder'=>'254xxxxxxxxx']
            ])
            /*->add('guarantor',EntityType::class,[
                'class' => User::class,
                'choice_label' => 'first_name'.'last_name',
            ])*/
            //->add('guarantor')
            ->add('emailAddress')
            ->add('emailAddress2')
            ->add('website')
            ->add('isCollectingSocietiesMember',ChoiceType::class,array(
                'choices'=>array(
                    'Yes'=>true,
		    'No'=>false,
                ),
                'multiple'=>false,
                'expanded'=>true,
                'required' => true,
            ))
            ->add('collectingSocieties')
            ->add('isApplyingForMinor',ChoiceType::class,array(
                'choices'=>array(
                    'Yes'=>true,
                    'No'=>false,
                ),
                'data' => false,
                'multiple'=>false,
                'expanded'=>true,
                'required' => true
            ))
            ->add('minorFname')
            ->add('minorSname')
            ->add('minorLname')
            ->add('minorAge')
            ->add('territorialAssignment', ChoiceType::class, array(
                'choices' => array(
                    'World Wide' => 'World Wide',
                    'Kenya' => 'Kenya',
                    'Africa' => 'Africa',
                ),
		'data' => 'World Wide',
                'placeholder'=>'Select'
            ))
            ->add('collectingSocietiesNumber')
            ->add('paymentMpesaNumber',null,[
                'attr'=>['placeholder'=>'2547xxxxxxxx']])
            ->add('royaltiesMpesaNumber',null,[
                'attr'=>['placeholder'=>'2547xxxxxxxx']])
            ->add('accountName')
            ->add('accountNumber')
            ->add('bank',ChoiceType::class, array(
                'choices' => array(
                    'Africa Banking Corporation' => 'Africa Banking Corporation',
                    'Bank of Africa' => 'Bank of Africa',
                    'Bank of Baroda' => 'Bank of Baroda',
                    'Bank of India' => 'Bank of India',
                    'Barclays Bank' => 'Barclays Bank',
                    'CFC Stanbic Bank' => 'CFC Stanbic Bank',
                    'Chase Bank' => 'Chase Bank',
                    'Citibank NA' => 'Citibank NA',
                    'Commercial Bank of Africa' => 'Commercial Bank of Africa',
                    'Consolidated Bank' => 'Consolidated Bank',
                    'Co-operative Bank' => 'Co-operative Bank',
                    'Credit Bank' => 'Credit Bank',
                    'Development Bank' => 'Development Bank',
                    'Diamond Trust Bank' => 'Diamond Trust Bank',
                    'Dubai Bank' => 'Dubai Bank',
                    'Ecobank' => 'Ecobank',
                    'Equitorial Commercial Bank' => 'Equitorial Commercial Bank',
                    'Equity Bank' => 'Equity Bank',
                    'Family Bank' => 'Family Bank',
                    'Fidelity Commercial Bank' => 'Fidelity Commercial Bank',
                    'Fina Bank' => 'Fina Bank',
                    'First Community Bank' => 'First Community Bank',
                    'Giro Commercial Bank' => 'Giro Commercial Bank',
                    'Guardian Bank' => 'Guardian Bank',
                    'Gulf African Bank' => 'Gulf African Bank',
                    'Habib Bank A.G Zurich' => 'Habib Bank A.G Zurich',
                    'Habib Bank' => 'Habib Bank',
                    'Imperial Bank' => 'Imperial Bank',
                    'I&M Bank' => 'I&M Bank',
                    'Jamii Bora Bank' => 'Jamii Bora Bank',
                    'Kenya Commercial Bank' => 'Kenya Commercial Bank',
                    'K-Rep Bank' => 'K-Rep Bank',
                    'Middle East Bank' => 'Middle East Bank',
                    'National Bank of Kenya' => 'National Bank of Kenya',
                    'NIC Bank' => 'NIC Bank',
                    'Oriental Commercial Bank' => 'Oriental Commercial Bank',
                    'Paramount Universal Bank' => 'Paramount Universal Bank',
                    'Prime Bank' => 'Prime Bank',
                    'Standard Chartered Bank' => 'Standard Chartered Bank',
                    'Trans-National Bank' => 'Trans-National Bank',
                    'UBA Kenya Bank' => 'UBA Kenya Bank',
                    'Victoria Commercial Bank' => 'Victoria Commercial Bank',
                    'Housing Finance' => 'Housing Finance',
                ),
                'placeholder'=>'Select'
            ))
            ->add('bankBranch')
           /* ->add('bankCode')
            ->add('swiftCode')*/;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Profile'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_applicant_details_form';
    }
}

