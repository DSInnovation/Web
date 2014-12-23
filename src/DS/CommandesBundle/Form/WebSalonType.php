<?php

namespace DS\CommandesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WebSalonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('refSalon')
            ->add('idRegion')
            ->add('adresse')
            ->add('tel')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DS\CommandesBundle\Entity\WebSalon'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ds_commandesbundle_websalon';
    }
}
