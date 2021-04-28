<?php

namespace App\Form;

use App\Entity\Group;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\MemberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GroupEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
                
        $builder
                 ->add('members', CollectionType::class, array('entry_type' => MemberType::class));

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                                     'data_class' => Group::class,
                                      'attr' => ['id' => 'groupedit']
                                     ));
    }
    public function getName()
    {
        return 'groupedit';
    }
}