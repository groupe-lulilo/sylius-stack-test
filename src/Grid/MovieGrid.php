<?php

declare(strict_types=1);

namespace App\Grid;

use App\Entity\Movie;
use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\DateTimeField;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\Filter\BooleanFilter;
use Sylius\Bundle\GridBundle\Builder\Filter\StringFilter;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class MovieGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_movie';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->setLimits([10, 25, 50, 100])
            ->addFilter(
                BooleanFilter::create('archived')
                    ->setLabel('app.ui.archived')
                    ->setDefaultValue('false'),
            )
            ->addFilter(
                StringFilter::create('title')
                    ->setLabel('app.ui.title')
            )
            ->addField(
                StringField::create('id')
                    ->setEnabled(false)
                    ->setSortable(true),
            )
            ->addField(
                StringField::create('title')
                    ->setSortable(true),
            )
            ->addField(
                DateTimeField::create('releaseDate')
                    ->setSortable(true),
            )
            ->addField(
                StringField::create('archived'),
            )
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create(),
                ),
            )
            ->addActionGroup(
                ItemActionGroup::create(
                    ShowAction::create(),
                    UpdateAction::create(),
                    Action::create('duplicate', 'create')
                        ->setLabel('app.ui.duplicate')
                        ->setOptions([
                            'link' => [
                                'route' => 'app_admin_movie_duplicate',
                                'parameters' => [
                                    'id' => 'resource.id',
                                ],
                            ],
                        ]),
                    DeleteAction::create()
                ),
            )
        ;
    }

    public function getResourceClass(): string
    {
        return Movie::class;
    }
}
