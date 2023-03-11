<?php

namespace App\UI\Web\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('email', EmailType::class, ["label" => "Email address"])
            ->add('password', PasswordType::class, ["label" => "Password"])
            ->add('password2', PasswordType::class, ["label" => "Repeat password"])
            ->add('register', SubmitType::class, ["label" => "Register"])
        ;

    }
}