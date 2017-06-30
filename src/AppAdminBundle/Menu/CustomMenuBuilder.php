<?php

namespace AppAdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

/**
 * Class CustomMenuBuilder
 *
 * @package AppAdminBundle\Menu
 */
class CustomMenuBuilder
{
    /**
     * @var \Knp\Menu\FactoryInterface
     */
    private $factory;

    /**
     * CustomMenuBuilder constructor.
     *
     * @param \Knp\Menu\FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param array $options
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function createMainMenu(array $options)
    {
        /** @var ItemInterface $menu */
        $menu = $this->factory->createItem('custom_menu.root')
            ->setExtras([
                            'translation_domain' => 'SonataAdminBundle',
                        ])
        ;

        $menu->addChild('custom_menu.post_list', ['route' => 'app_post_list'])
            ->setExtra('translation_domain', 'SonataAdminBundle')
        ;

        return $menu;
    }
}
