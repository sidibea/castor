<?php

namespace CASTOR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class classesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('nom')
            ->add('isEnabled', 'choice', array(
                'choices' => array(true => 'Oui', false => 'Non'),
                'expanded' => true
            ))
            ->add('dateTrimestriel', 'collection', array(
                'type'         => new date_trimestrielType(),
                'allow_add'    => true,
                'allow_delete' => true
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CASTOR\AdminBundle\Entity\classes'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'castor_adminbundle_classes';
    }
}
