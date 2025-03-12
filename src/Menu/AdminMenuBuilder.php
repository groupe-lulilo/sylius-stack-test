<?php

declare(strict_types=1);

namespace App\Menu;

use Knp\Menu\ItemInterface;
use Sylius\AdminUi\Knp\Menu\MenuBuilderInterface;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;

#[AsDecorator(decorates: 'sylius_admin_ui.knp.menu_builder')]
final class AdminMenuBuilder implements MenuBuilderInterface
{
    public function __construct(private MenuBuilderInterface $menuBuilder)
    {
    }

    /**
     * @param array<array-key, mixed> $options
     */
    public function createMenu(array $options): ItemInterface
    {
        $menu = $this->menuBuilder->createMenu($options);

        $menu
            ->addChild('dashboard', [
                'route' => 'sylius_admin_ui_dashboard',
            ])
            ->setLabel('sylius.ui.dashboard')
            ->setLabelAttribute('icon', 'tabler:dashboard')
        ;

        $subMenu = $menu->addChild('lulilo')
            ->setLabelAttribute('icon', 'tabler:gymnastics');

        $menu
            ->addChild('movies', [
                'route' => 'app_admin_movie_index',
            ])
        ;

        $subMenu->addChild('suppliers', [
            'route' => 'app_admin_supplier_index',
        ])
        ;
        $subMenu->addChild('articles', [
            'route' => 'app_admin_product_index',
        ])
        ;
        $subMenu->addChild('categories', [
            'route' => 'app_admin_category_index',
        ])
        ;
        $subMenu->addChild('brand', [
            'route' => 'app_admin_brand_index',
        ])
        ;
        $menu->addChild('diagram', [
            'route' => 'app_diagram',
        ]);

        return $menu;
    }
}

