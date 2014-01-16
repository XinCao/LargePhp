<?php
namespace DreamHeaven\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class TabBuilder extends BaseBuilder
{
    protected $tabParamName = 'tab';

    public function tabs(FactoryInterface $factory, array $options)
    {
        $tabs = $factory->createItem('root');
        $request = $this->container->get('request');

        if(isset($options['tab_param']))
        {
            $this->tabParamName = $options['tab_param'];
        }

        $class = isset($options['class']) ? $options['class'] : 'nav nav-tabs';
        $tabs->setChildrenAttribute('class', $class);

        $tabItems = $options['tabs'];

        foreach ($tabItems as $item)
        {
            if(!$this->isAccessable($item))
            {
                continue;
            }

            $tab = $factory->createItem($item['name'], $item);
            if(isset($item['icon']))
            {
                $tab->setExtra('icon', $item['icon']);
            }
            if(isset($item['badge']))
            {
                $tab->setExtra('badge', $item['badge']);
            }
            elseif(isset($item['badgeCallback']))
            {
                $callback = $this->parseCallback($item['badgeCallback']);
                if(is_callable($callback))
                {
                    $args = isset($item['badgeCallbackArgs']) ? $item['badgeCallbackArgs'] : null;
                    $badge = call_user_func_array($callback, (array)$args);
                    if($badge || isset($item['alwaysDisplayBadge']))
                    {
                        $tab->setExtra('badge', (int)$badge);
                    }
                }
            }

            $isCurrent = $this->isCurrent($item, $request);
            $tab->setCurrent($isCurrent);

            $tabs->addChild($tab);
        }

        return $tabs;
    }

    protected function parseCallback($callbackName)
    {
        if(is_callable($callbackName))
        {
            return $callbackName;
        }

        if(strpos($callbackName, ':') !== false)
        {
            list($serviceName, $methodName) = explode(':', $callbackName);
            $service = $this->container->get($serviceName);
            return array($service, $methodName);
        }
    }

    protected function isCurrent($item)
    {
        if(!parent::isCurrent($item))
        {
            return false;
        }

        $request = $this->container->get('request');
        $currentTab  = $request->query->get($this->tabParamName);
        $menuItemTab = isset($item['routeParameters'][$this->tabParamName]) ? $item['routeParameters'][$this->tabParamName] : null;

        return $currentTab === $menuItemTab;
    }
}
