<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EntryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');

        $builder->add('addresses', 'collection', array(
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'label' => 'Címek',
            'type' => new EntryAddressType()
        ));

        $builder->add('emails', 'collection', array(
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'label' => 'E-mail címek',
            'type' => new EntryEmailType()
        ));

        $builder->add('phones', 'collection', array(
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'label' => 'Telefonszámok',
            'type' => new EntryPhoneType()
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Entry'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_entry';
    }
}
