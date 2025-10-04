<?php

namespace App\Form;

use App\Entity\Refuge;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
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
            ->add('dateStart', HiddenType::class, [
                'attr' => [
                    'class' => 'dateStartForm',
                ]
            ])
            ->add('dateEnd', HiddenType::class, [
                'attr' => [
                    'class' => 'dateEndForm'
                ]
            ])

            ->addEventListener(FormEvents::PRE_SUBMIT, function (PreSubmitEvent $event): void {
                $data = $event->getData();
                $dateStart = new DateTime($data['dateStart']);
                $dateEnd = new DateTime($data['dateEnd']);

                $data['dateStart'] = $dateStart;
                $data['dateEnd'] = $dateEnd;
                $event->setData($data);
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Refuge::class,
        ]);
    }
}
