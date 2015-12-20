<?php

namespace CASTOR\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ElevesType extends AbstractType
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
            ->add('nationalite')
            ->add('etatSanitaire')
            ->add('etablissementOrigine')
            ->add('langueVivante')
            ->add('tel')
            ->add('nomPere')
            ->add('professionPere')
            ->add('telPere')
            ->add('emailPere')
            ->add('nomMere')
            ->add('professionMere')
            ->add('telMere')
            ->add('emailMere')
            ->add('adresse', 'textarea')
            ->add('classe', 'entity', array(
                'class'    => 'CASTORAdminBundle:classes',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.isEnabled = :isEnabled')
                        ->setParameter('isEnabled', true);
                },
                'property' => 'nom',
                'multiple' => false
            ))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CASTOR\AdminBundle\Entity\Eleves'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'castor_adminbundle_eleves';
    }
}
