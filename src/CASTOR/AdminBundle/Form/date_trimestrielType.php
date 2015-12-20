<?php

namespace CASTOR\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class date_trimestrielType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut', 'text', array(
                'attr' => array(
                    'class' => 'form-control datepicker'
                )
            ))
            ->add('dateFin', 'text', array(
                'attr' => array(
                    'class' => 'form-control datepicker'
                )
            ))
            ->add('trimChoix', 'choice', array(
                'choices' => array('trimestre1' => 'Trimestre 1', 'trimestre2' => 'Trimestre 2', 'trimestre3' => 'trimestre 3'),
                'expanded' => false,
                'multiple' => false,
                'attr' => array('class' => 'form-control')

            ))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CASTOR\AdminBundle\Entity\date_trimestriel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'castor_adminbundle_date_trimestriel';
    }
}
