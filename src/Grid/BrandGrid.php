<?php

    namespace App\Grid;

    use App\Entity\Brand;
    use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
    use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
    use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
    use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
    use Sylius\Bundle\GridBundle\Builder\ActionGroup\BulkActionGroup;
    use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
    use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
    use Sylius\Bundle\GridBundle\Builder\Field\StringField;
    use Sylius\Bundle\GridBundle\Builder\Filter\StringFilter;
    use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
    use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
    use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

    final class BrandGrid extends AbstractGrid implements ResourceAwareGridInterface
    {
        public function __construct()
        {
            // TODO inject services if required
        }

        public static function getName(): string
        {
            return 'app_brand';
        }

        public function buildGrid(GridBuilderInterface $gridBuilder): void

        {
            $gridBuilder
                ->setLimits([10, 25, 50, 100])
                // see https://github.com/Sylius/SyliusGridBundle/blob/master/docs/field_types.md
                ->addFilter(StringFilter::create('title')
                    ->setLabel('app.ui.name')
                )
                ->addField(
                    StringField::create('title')
                        ->setLabel('Title')
                        ->setSortable(true)
                )
                ->addActionGroup(
                    MainActionGroup::create(
                        CreateAction::create(),
                    )
                )
                ->addActionGroup(
                    ItemActionGroup::create(
                        ShowAction::create(),
                        UpdateAction::create(),
                        DeleteAction::create()
                    )
                );
        }

        public function getResourceClass(): string
        {
            return Brand::class;
        }
    }
