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
            ->add('Poste')
            ->add('nomEntreprise')
            ->add('Lieu')
            ->add('typeEmploi')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('description')
            ->add('cv')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ExperiencePro::class,
        ]);
    }
}
