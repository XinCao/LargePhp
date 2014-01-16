<?php
namespace DreamHeaven\AdminBundle\Menu;
use Knp\Menu\FactoryInterface;

class MenuBuilder extends BaseBuilder {
    
    public function build(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav nav-list');
        if(!isset($options['menu']) || !isset($options['menu']['items'])) {
            return $menu;
        }
        $headerItem = $this->createMenuItem($factory, array('label' => $options['menu']['name']));
        $headerItem->setAttribute('class', 'nav-header');
        $menu->addChild($headerItem);
        foreach ($options['menu']['items'] as $item) {
            if(!$this->isAccessable($item)) {
                continue;
            }
            $menuItem = $this->createMenuItem($factory, $item);
            $menuItem->setChildrenAttribute('class', 'nav nav-list');
            $isCurrent = $this->isCurrent($item);
            $menuItem->setCurrent($isCurrent);
            if(isset($item['children'])) {
                foreach ($item['children'] as $childMenuItem) {
                    $childMenuItem = $this->createMenuItem($factory, $child);
                    $isCurrent = $this->isCurrent($childMenuItem);
                    $childMenuItem->setCurrent($isCurrent);
                    $menuItem->addChild($childMenuItem);
                }
            }
            $menu->addChild($menuItem);
        }
        return $menu;
    }
    
    protected function createMenuItem(FactoryInterface $factory, $item) {
        if(!isset($item['label']) && isset($item['name'])) {
            $item['label'] = $item['name'];
        }
        if(!isset($item['uri']) && isset($item['route'])) {
            $router = $this->container->get('router');
            $item['uri'] = $router->generate($item['route'], array(), false);
        }
        if(isset($item['icon'])) {
            $item['extras']['icon'] = $item['icon'];
        }
        $menuItem = $factory->createItem($item['label'], $item);
        return $menuItem;
    }
}
