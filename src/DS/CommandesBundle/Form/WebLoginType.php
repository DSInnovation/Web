<?php

namespace DS\CommandesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WebLoginType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idLogin')
            ->add('idCli')
            ->add('username')
            ->add('mdP')
            ->add('isActivite')
            ->add('refSalon')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DS\CommandesBundle\Entity\WebLogin'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ds_commandesbundle_weblogin';
    }
}
