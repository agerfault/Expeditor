<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EmployeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class, ['label' => 'Nom de l\'employé : *','required' => true,'attr' => ['class'=> 'form-control'] ])
            ->add('motdepasse',TextType::class, ['label' => 'Mot de passe : *','required' => true,'attr' => ['class'=> 'form-control'] ])
            //->add('statut',IntegerType::class, ['label' => 'Statut de l\'employé : *','required' => true,'attr' => ['class'=> 'form-control', 'min' => 1] ])
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'Employé' => 1,
                    'Manager' => 2], 'attr' => ['class' => 'form-control']
                ]);
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Employe'
        ));
    }
}
