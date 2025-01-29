<?php

namespace App\Grid;

use App\Entity\Supplier;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\BulkActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\DateTimeField;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;
use Sylius\Bundle\GridBundle\Builder\Filter\StringFilter;
use Sylius\Bundle\GridBundle\Builder\Filter\DateFilter;

final class SupplierGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public function __construct()
    {
        // TODO inject services if required
    }

    public static function getName(): string
    {
        return 'app_supplier';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->setLimits([10, 25, 50, 100])
            // see https://github.com/Sylius/SyliusGridBundle/blob/master/docs/field_types.md
            ->addFilter(StringFilter::create('name')
                ->setLabel('app.ui.name')
            )
            ->addFilter(DateFilter::create('last_order_date')
                ->setLabel('app.ui.last_order_date')
            )
            ->addFilter(DateFilter::create('created_at'))
            ->addFilter(StringFilter::create('manager_name')
                ->setLabel('app.ui.manager_name')
            )
            ->addFilter(StringFilter::create('address')
                ->setLabel('app.ui.address')
            )
            ->addFilter(StringFilter::create('phone')
                ->setLabel('app.ui.phone')
            )
            ->addField(
                StringField::create('name')
                    ->setLabel('Name')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('address')
                    ->setLabel('Address')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('phone')
                    ->setLabel('Phone')
                    ->setSortable(true)
            )
            ->addField(
                DateTimeField::create('last_order_date')
                    ->setLabel('Last_order_date')
            )
            ->addField(
                StringField::create('manager_name')
                    ->setLabel('Manager_name')
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
            )
        ;
    }

    public function getResourceClass(): string
    {
        return Supplier::class;
    }
}
