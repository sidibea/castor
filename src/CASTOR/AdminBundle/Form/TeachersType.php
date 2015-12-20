<?php

namespace CASTOR\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeachersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('sexe', 'choice', array(
                'choices' => array('M' => 'Garcon', 'F' => 'Fille'),
                'expanded' => false,
            ))
            ->add('dob')
            ->add('lieuNaissance')
            ->add('adresse', 'textarea')
            ->add('codePostal')
            ->add('ville')
            ->add('qualite')
            ->add('diplome')
            ->add('telephone')
            ->add('email')
            ->add('matieres', 'entity', array(
                'class'    => 'CASTORAdminBundle:Matieres',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->where('m.isEnabled = :isEnabled')
                        ->setParameter('isEnabled', true);
                },
                'property' => 'nom',
                'multiple' => true
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CASTOR\AdminBundle\Entity\Teachers'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'castor_adminbundle_teachers';
    }
}
