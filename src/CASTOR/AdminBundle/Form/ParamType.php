<?php

namespace CASTOR\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ParamType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomDirecteur')
            ->add('signatureDirecteur', 'file' , array(
                'data_class' => null,
                'required' => false
            ))
            ->add('nomEtablissement')
            ->add('academie')
            ->add('anneeScolaire', 'choice', array(
                'choices' => array(
                    (date('Y')-1)."-".(date('Y')) => (date('Y') -1)."-".(date('Y')),
                    date('Y')."-".(date('Y') + 1) => (date('Y'))."-".(date('Y') +1)),
                'expanded' => false
            ))
            ->add('adresse', 'textarea')
            ->add('codePostal')
            ->add('ville')
            ->add('telephone')
            ->add('email')
            ->add('siteweb')
            ->add('logo', 'file', array(
                'data_class' => null,
                'required' => false

            ))
        ;


        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
            function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
                // On récupère notre objet Advert sous-jacent
                $param = $event->getData();

                // Cette condition est importante, on en reparle plus loin
                if (null === $param) {
                    return; // On sort de la fonction sans rien faire lorsque $advert vaut null
                }

                if ($param->getLogo() != null ) {
                    // Si l'annonce n'est pas publiée, ou si elle n'existe pas encore en base (id est null),
                    // alors on ajoute le champ published
                    $event->getForm()->add('logo', 'file', array(
                        'required' => false,
                        'mapped' => false,
                    ));
                }
                if ($param->getSignatureDirecteur() != null ) {
                    // Si l'annonce n'est pas publiée, ou si elle n'existe pas encore en base (id est null),
                    // alors on ajoute le champ published
                    $event->getForm()->add('signatureDirecteur', 'file', array(
                        'required' => false,
                        'mapped' => false,
                    ));
                }

            }
        );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CASTOR\AdminBundle\Entity\Param'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'castor_adminbundle_param';
    }
}
