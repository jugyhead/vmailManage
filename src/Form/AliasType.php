<?php

namespace App\Form;

use App\Entity\Domain;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Class AliasType
 * @package App\Form
 * @author Andreas Bresch
 */
class AliasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('source_username', TextType::class)
            ->add('source_domain', EntityType::class, array(
                'class' => Domain::class,
                'choice_label' => function(Domain $domain) {
                    return $domain->getName() . ($domain->getIsAliasDomain() ? ' (alias Domain)' : '');
                },
                'placeholder' => 'Choose a domain',
            ))
            ->add('destination_username', TextType::class)
            ->add('destination_domain', TextType::class)
            ->add('enabled', CheckboxType::class)
            ->add('save', SubmitType::class, array('label' => 'submit'))
        ;
    }
}
