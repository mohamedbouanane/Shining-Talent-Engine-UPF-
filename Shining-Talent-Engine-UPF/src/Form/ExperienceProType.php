<?php

namespace App\Form;

use App\Entity\ExperiencePro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceProType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('poste')
            ->add('nomEntreprise')
            ->add('ville')
            ->add('typeEmploi')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ExperiencePro::class,
        ]);
    }
}
