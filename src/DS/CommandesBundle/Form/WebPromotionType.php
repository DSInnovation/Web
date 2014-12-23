<?php

namespace DS\CommandesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WebPromotionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codePromo')
            ->add('taux')
            ->add('idProd')
            ->add('refSalon')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DS\CommandesBundle\Entity\WebPromotion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ds_commandesbundle_webpromotion';
    }
}
