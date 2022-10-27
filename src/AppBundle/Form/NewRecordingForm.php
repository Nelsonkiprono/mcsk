<?php

namespace AppBundle\Form;

use AppBundle\Entity\DocumentFile;
use AppBundle\Entity\RecordingFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewRecordingForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('albumTitle')
            ->add('recordingTitle')
            ->add('declarationType', ChoiceType::class, [
                'choices' => array(
                    'Sound' => 'Sound',
                ),
                'data' => 'Sound',
                'required' => true,
                'label' => 'Recording Type',
            ])
            ->add('yearProduction',IntegerType::class,[
                'attr'=>[
                    'label'=>'Year of Production'
                ]
            ])
            ->add('recordingStudio')
            ->add('countryOfRecording',CountryType::class)
            ->add('countryOfProduction',CountryType::class)
            ->add('format', ChoiceType::class, [
                'choices' => array(
                    'MP3' => 'MP3',
                ),
                'data' => 'MP3',
                'required' => true,
                'label' => 'Format',
            ])
            ->add('mainArtist')
            ->add('documentFile',DocumentFileForm::class,[
                'label'=>'Signed Audio/Visual Declaration Form',
                'required'=>true
            ])
            ->add('recordingFile',RecordingFileForm::class)
            ->add('musicCategory', ChoiceType::class, [
                'choices' => array(
                    'Secular' => 'Secular',
                    'Gospel' => 'Gospel',
                    'Patriotic' => 'Patriotic',

                ),
                'required' => false,
                'label' => 'Category',
                'placeholder'=>'Select'
            ])
            ->add('backgroundVocals',TextareaType::class,[
                'required'=>false,
                'label'=>'Background Vocalists'
            ])
            ->add('trackProgramming')
            ->add('otherInstrumentalists',TextareaType::class,[
                'required'=>false,
                'label'=>'Name of Instrumentalists (Instrument - Instrumentalist)',
            ])
            ->add('musicStyle', ChoiceType::class, [
                'choices' => array(
                    'Jazz' => 'Jazz',
                    'Hip-Hop' => 'Hip-Hop',
                    'RnB' => 'RnB',
                    'Rock' => 'Rock',
                    'Pop'  => 'Pop',
                    'Classical' => ' Classical',
                    'Electronic' => 'Electronic',
                    'Rhumba'    => 'Rhumba',
                    'Zouk'      => 'Zouk',
                    'Benga'     => 'Benga',
                    'Stakato'   => 'Stakato',
                    'Kwaito'    => 'Kwaito',
                    'Taarab'=>'Taarab',
                    'Reggae'=>'Reggae',
                    'Other' => 'Other'

                ),
                'required' => false,
                'label' => 'Genre',
                'placeholder'=>'Select'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Music'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_new_recording_form';
    }
}
