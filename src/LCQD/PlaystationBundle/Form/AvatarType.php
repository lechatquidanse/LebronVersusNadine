<?php

namespace LCQD\PlaystationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvatarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('aboutMe', 'textarea')
            ->add('birthdayAt', 'datetime')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LCQD\PlaystationBundle\Entity\Avatar'
        ));
    }

    public function getName()
    {
        return 'lcqd_playstation_avatar';
    }
}
