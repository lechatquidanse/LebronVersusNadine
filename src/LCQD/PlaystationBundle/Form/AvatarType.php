<?php

/**
 * This file is part of the Playstation package.
 *
 * (c) lechatquidanse
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LCQD\PlaystationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Avatar Type
 *
 * Avatar form builder
 * 
 * @author lechatquidanse
 */
class AvatarType extends AbstractType
{
    /**
     * {@inheritdoc}
     * 
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('aboutMe', 'textarea')
            ->add('birthdayAt', 'datetime')
        ;
    }

    /**
     * {@inheritdoc}
     * 
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LCQD\PlaystationBundle\Entity\Avatar'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'lcqd_playstation_avatar';
    }
}
