<?php
namespace Iwin\Bundle\AppBundle\Service\Util;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Главное меню
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class MenuBuilder
{
    /**
     * @param FactoryInterface         $factory
     * @param SecurityContextInterface $security
     * @return ItemInterface
     */
    public function createMain(
        FactoryInterface $factory,
        SecurityContextInterface $security
    ) {
        $menu = $factory->createItem('root');

        $menu->addChild('menu.advert', [
            'route' => 'home',
        ])->setExtra('translation_domain', 'IwinAppBundle');
        $menu->addChild('menu.services', [
            'route' => 'home',
        ])->setExtra('translation_domain', 'IwinAppBundle');
        $menu->addChild('menu.advices', [
            'route' => 'home',
        ])->setExtra('translation_domain', 'IwinAppBundle');

        return $menu;
    }
}
