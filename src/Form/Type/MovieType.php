<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Movie;
use Symfony\Component\Clock\ClockInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

final class MovieType extends AbstractType
{
    public function __construct(
        private ClockInterface $clock,
    ) {
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'empty_data' => '',
            ])
            ->add('releaseDate', DateType::class, [
                'input' => 'datetime_immutable',
                'empty_data' => $this->clock->now()->format('Y-m-d'),
            ])
            ->add('actors', LiveCollectionType::class, [
                'required' => false,
                'entry_type' => ActorType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
