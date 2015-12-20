<?php

namespace CASTOR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class classesEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    }
    


    /**
     * @return string
     */
    public function getName()
    {
        return 'castor_adminbundle_classes_edit';
    }
    public function getParent(){
        return new classesType();
    }
}
