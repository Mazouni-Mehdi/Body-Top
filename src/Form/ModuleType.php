<?php

namespace App\Form;

use App\Entity\Module;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('planning', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'label' => 'Gérer planning équipe : ',
                'choices' => [
                    'Oui' => '1',
                    'Non' => '0',
                ]
            ])
            ->add('registration', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'label' => 'Service dinscription sur internet : ',
                'choices' => [
                    'Oui' => '1',
                    'Non' => '0',
                ]
            ])
            ->add('negotiation', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'label' => 'Négociation prix fournisseur : ',
                'choices' => [
                    'Oui' => '1',
                    'Non' => '0',
                ]
            ])
            ->add('sale', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'label' => 'Vendre des boissons : ',
                'choices' => [
                    'Oui' => '1',
                    'Non' => '0',
                ]
            ])
            ->add('advertising', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'label' => 'Publiciter de la salle : ',
                'choices' => [
                    'Oui' => '1',
                    'Non' => '0',
                ]
            ])
            ->add('mailing', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'label' => 'faire son mailing : ',
                'choices' => [
                    'Oui' => '1',
                    'Non' => '0',
                ]
            ])
            ->add('training', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'label' => 'Suivre les formations : ',
                'choices' => [
                    'Oui' => '1',
                    'Non' => '0',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Module::class,
        ]);
    }
}
