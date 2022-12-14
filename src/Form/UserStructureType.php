<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserStructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("email", EmailType::class, [
                "label" => "adresse mail : ",
                "required" => true,
                //'row_attr' => ['class' => 'nom', 'id' => 'name'],
                "constraints" => [
                    new Length(["min" => 10, "max" => 180, "minMessage" => "L'adresse mail doit faire plus de 10 caractères", "maxMessage" => "L'adresse mail ne doit pas faire plus de 180 caractères"]),
                    new NotBlank(["message" => "L'adresse mail ne doit pas être vide !"]),
                ]
            ])
            ->add("password", PasswordType::class, [
                "label" => "Mot de passe : ",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Le mot de passe ne peut pas être vide !"])
                ]
            ])
            ->add('structure', StructureType::class, [
                "label" => "structures"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'user_item',
        ]);
    }
}
