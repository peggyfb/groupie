<?php

namespace App\Form;

use App\Entity\Group;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GroupCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('cn', TextType::class, array(
                                        'label' => 'Nom',
                                         'required' => true
                                         ))

            ->add('description', TextType::class, array(
                                             'required' => true
                                             ))

            ->add('amugroupfilter', TextType::class, array(
                                                'label' => 'Filtre',
                                                'required' => false
                                                ))
            ->getForm()
            /*->add('Créer', 'createButton', array(
                                                'attr' => array(
                                                                'class'   => 'ui-button ui-widget-content ui-corner-all',
                                                                'onclick' => 'loadPage(\''.$options['action'].'\', $(\'#'.$options['attr']['id'].'\').serializeArray());'
                                                                )
                                                )
                  )

            ->add('Annuler', 'cancelButton', array(
                                                   'attr' => array(
                                                                   'class'   => 'ui-button ui-widget-content ui-corner-all',
                                                                   'onclick' => 'loadPage(\''.$options['attr']['cancelRoute'].'\');'
                                                                   )
                                                   )
                  )*/;

        /*Voici quelques exemples de personnalisations de champs :
         =========================================================

         // colorpicker    ->add('fieldname','text',array('label'=>'Label de FIELD_NAME','attr' => array('type'=>'color','class' => 'optional spectrum'),'required'=>false))
         // textarea       ->add('fieldname','textarea',array('label'=>'Label de FIELD_NAME','required'=>true,'attr' => array('style'=>'min-width:600px;min-height:100px;')))
         // ckeditor(full) ->add('fieldname','ckeditor',array('label'=>'Label de FIELD_NAME','required'=>true,'attr' => array('class' => 'ckeditor')))
         // ckeditor(light)->add('fieldname','ckeditor',array('label'=>'Label de FIELD_NAME','required'=>true,'attr' => array('class' => 'ckeditor','config_name'=>'light')))
         // datetimepicker ->add('fieldname','datetime',array('label'=>'Label de FIELD_NAME','required'=>true,'widget' => 'single_text','format' => 'dd/MM/yyyy HH:mm', 'attr' => array('class' => 'datetimepicker')))
         // datepicker     ->add('fieldname','date',array('label'=>'Label de FIELD_NAME','required'=>true,'widget' => 'single_text','format' => 'dd/MM/yyyy', 'attr' => array('class' => 'datepicker')))
         // timepicker     ->add('fieldname','time',array('label'=>'Label de FIELD_NAME','required'=>true,'widget' => 'single_text','format' => 'HH:mm', 'attr' => array('class' => 'timepicker')))

         */

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Group::class)
                               );
    }

    public function getName()
    {
        return 'amu_cligrouperbundle_group';
    }
}