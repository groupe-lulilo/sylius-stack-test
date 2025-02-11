<?php

    namespace App\Form\Type;

    use App\Entity\Product;
    use App\Entity\Brand;
    use App\Entity\Category;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\NumberType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\FormError;
    use Symfony\Component\Form\FormEvent;
    use Symfony\Component\Form\FormEvents;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    final class ProductType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('title')
                ->add('priceSupplier', NumberType::class, [
                    'label' => 'Supplier purchase price',
                    'required' => true,
                ])
                ->add('price', NumberType::class, [
                    'label' => 'Selling price',
                    'required' => true,
                    'attr' => [
                        'min' => 0
                    ]
                ])
                ->add('brand', EntityType::class, [
                    'class' => Brand::class,
                    'choice_label' => 'title',
                ])
                ->add('referenceSupplier')
                ->add('description')
                ->add('category', EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'title',
                ])
                ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
                    $form = $event->getForm();
                    $product = $form->getData();

                    if ($product->getPrice() !== null && $product->getPriceSupplier() !== null) {
                        if ($product->getPrice() < $product->getPriceSupplier() * 1.25) {
                            $form->get('price')->addError(
                                new FormError('The selling price must be at least 25% higher than the supplier\'s purchase price.')
                            );
                        }
                    }
                })
            ;
        }

        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => Product::class,
            ]);
        }
    }
