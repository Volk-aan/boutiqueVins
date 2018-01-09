<?php

namespace CitadelleDuVin\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', TextType::class, array('label' => 'Nom'))
            ->add('firstName', TextType::class, array('label' => 'Prénom'))
            ->add('street', TextType::class, array('label' => 'Rue'))
            ->add('postalCode', TextType::class, array('label' => 'Code Postal'))
            ->add('city', TextType::class, array('label' => 'Localité'))
            ->add('phoneNumber', TextType::class, array('label' => 'Téléphone','required' => false))
            ->add('username', TextType::class, array('label' => 'Email'))
            ->add('password', RepeatedType::class, array(
                'type'            => PasswordType::class,
                 'options'         => array('required' => true),
                 'first_options'   => array('label' => 'Mot de passe'),
                 'second_options'  => array('label' => 'Répéter le mot de passe'),
            ));
    }

    public function getName()
    {
        return 'user';
    }
}
