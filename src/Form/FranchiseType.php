<?php

namespace App\Form;

use App\Entity\Franchise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class FranchiseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("name", TextType::class, [
                "label" => "Nom de la franchise : ",
                "required" => true,
                //'row_attr' => ['class' => 'nom', 'id' => 'name'],
                "constraints" => [
                    new Length(["min" => 2, "max" => 50, "minMessage" => "Le nom de la franchise doit faire plus de 2 caractères", "maxMessage" => "Le nom de la franchise ne doit pas faire plus de 50 caractères"]),
                    new NotBlank(["message" => "Le nom de la franchise ne doit pas être vide !"]),
                ]
            ])
            ->add('is_active', CheckboxType::class, [
                "label" => "Activer la Franchise : ",
                "required" => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Franchise::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'user_item',
        ]);
    }
}
