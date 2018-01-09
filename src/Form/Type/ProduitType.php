<?php

namespace CitadelleDuVin\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('name', TextType::class);
        $builder->add('description', TextAreaType::class);
        $builder->add('year', IntegerType::class);
        $builder->add('alcool', TextType::class);
        $builder->add('temperature', TextType::class);
        $builder->add('stock', IntegerType::class);
        $builder->add('bio', CheckboxType::class, array( 'required' => false ));
        $builder->add('price', MoneyType::class);
        $builder->add('picture', FileType::class);
    }

    public function getName()
    {
        return 'produit';
    }
}