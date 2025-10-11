<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\DataTransformer\StringToDateTimeTransformer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ReservationType extends AbstractType
{
    public function __construct(
        private StringToDateTimeTransformer $transformer,
    )
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateStart', HiddenType::class, [
                'attr' => [
                    'class' => 'dateStartForm input',
                ],
                'label' => false,
            ])
            ->add('dateEnd', HiddenType::class, [
                'attr' => [
                    'class' => 'dateEndForm input',
                ],
                'label' => false,
            ])
        ;

        $builder
            ->get('dateStart')
            ->addModelTransformer($this->transformer)
        ;

        $builder
            ->get('dateEnd')
            ->addModelTransformer($this->transformer)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
