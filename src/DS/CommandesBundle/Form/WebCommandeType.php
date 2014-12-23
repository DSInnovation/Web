<?php

namespace DS\CommandesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WebCommandeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numCom')
            ->add('idLogin')
            ->add('dateCom')
            ->add('refSalon')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DS\CommandesBundle\Entity\WebCommande'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ds_commandesbundle_webcommande';
    }
}
