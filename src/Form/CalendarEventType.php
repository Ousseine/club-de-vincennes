<?php

namespace App\Form;

use App\Entity\CalendarEvent;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('startAt', \Symfony\Component\Form\Extension\Core\Type\DateTimeType::class, [
               'date_widget' => 'single_text'
            ])
            ->add('endAt', \Symfony\Component\Form\Extension\Core\Type\DateTimeType::class, [
               'date_widget' => 'single_text'
            ])
            ->add('description')
            ->add('allDay')
            ->add('backgroundColor', ColorType::class)
            ->add('textColor', ColorType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CalendarEvent::class,
        ]);
    }
}
