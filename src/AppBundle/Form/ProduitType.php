<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_fr')
            ->add('nom_en')
            //->add('univers_technologique')
            //->add('marche')
           // ->add('prix')
            ->add('description_fr')
            ->add('description_en')
            ->add('service_rendu_fr')
            ->add('service_rendu_en')
            //->add('img')
            //->add('qcode')
            //->add('pdf')
            //->add('avant')
            ->add('theme')
            ->add('nominer');
            //->add('lien_produit_fr')
            //->add('lien_produit_en');
            //->add('id_societe')
            //->add('salon')
            //->add('nomenclature');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_produit';
    }


}
