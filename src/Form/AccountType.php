<?php

namespace App\Form;

use App\Entity\Domain;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Class AccountType
 * @package App\Form
 * @author Andreas Bresch
 */
class AccountType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('domain', EntityType::class, array(
                'class' => Domain::class,
                'choice_label' => 'name',
                'placeholder' => 'Choose domain',
            ))
            ->add('password', TextType::class)
            ->add('quota', IntegerType::class)
            ->add('enabled', CheckboxType::class)
            ->add('sendonly', CheckboxType::class)
            ->add('save', SubmitType::class, array('label' => 'submit'))
        ;
    }

}
