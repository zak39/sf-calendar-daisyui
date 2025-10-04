<?php

namespace App\Form;

use App\Entity\Refuge;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefugeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'input'
                ],
                'label' => 'Nom du refuge',
                'label_attr' => [
                    'class' => 'input'
                ],
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'input'
                ],
                'label' => 'Adresse du refuge',
                'label_attr' => [
                    'class' => 'input'
                ],
            ])
            ->add('dateStart', DateType::class, [
                'label' => 'Date de la première nuité',
                'label_attr' => [
                    'class' => 'input'
                ],
            ])
            ->add('dateEnd', DateType::class, [
                'label' => 'Date de la dernière nuité',
                'label_attr' => [
                    'class' => 'input'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Refuge::class,
        ]);
    }
}
