<?php

namespace App\Form;

use App\Entity\Structure;
use App\Entity\Franchise;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class StructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('address', TextType::class, [
                'label' => "Adresse : ",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "L'adresse ne doit pas être vide !"]),
                    new Length(["min" => 5, "max" => 255,
                    "minMessage" => "L'adresse doit faire plus de 5 caractères",
                    "maxMessage" => "L'adresse ne doit pas faire plus de 255 caractères"]),
                ]
            ])
            ->add('zipcode', TextType::class, [
                'label' => "Code postal : ",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Le code postal ne doit pas être vide !"]),
                    /*new Length([ 5, "Message" => "Le code postal doit faire 5 caractères"]),*/
                ]
            ])
            ->add('city', TextType::class, [
                'label' => "Ville : ",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Le nom de ville ne doit pas être vide !"]),
                    new Length(["min" => 2, "max" => 150,
                    "minMessage" => "Le nom de ville doit faire plus de 2 caractères",
                    "maxMessage" => "Le nom de ville ne doit pas faire plus de 150 caractères"]),
                ]
            ])
            ->add('is_active', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'label' => 'Activer la structure : ',
                'choices' => [
                    'Oui' => 'true',
                    'Non' => 'false',
                ]
            ])
            /*->add('user', UserStructureType::class)*/
            ->add('franchise', EntityType::class, [
                'expanded' => false,
                'class' => Franchise::class,
                'multiple' => false,
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('h')
                        ->orderBy('h.name', 'ASC');
                },
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('Module', ModuleType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Structure::class,
        ]);
    }
}
