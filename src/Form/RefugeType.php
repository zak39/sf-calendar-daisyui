<?php

namespace App\Form;

use App\Entity\Refuge;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('reservations', CollectionType::class, [
                'entry_type' => ReservationType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
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
