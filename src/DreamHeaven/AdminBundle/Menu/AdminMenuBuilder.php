<?php
namespace DreamHeaven\AdminBundle\Menu;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class AdminMenuBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setUri($this->container->get('request')->getPathInfo());
        $menu->setChildrenAttribute('class', 'nav nav-list');

        $currentUser = $this->getCurrentUser();
        $menuItems = $this->getMenuItems($currentUser, $options);

        foreach ($menuItems as $item)
        {
            $menuItem = $this->createMenuItem($factory, $item);
            $menuItem->setChildrenAttribute('class', 'nav nav-list');
            if(isset($item['children']))
            {
                foreach ($item['children'] as $child)
                {
                    $childMenuItem = $this->createMenuItem($factory, $child);
                    $menuItem->addChild($childMenuItem);
                }
            }

            $menu->addChild($menuItem);
        }

        return $menu;
    }

    public function accountMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu = $factory->createItem('root');
        $menu->setAttributes(array(
            'class' => 'pull-right',
            'dropdown' => true,
            'divider_append' => true,
        ));
        $menu->setLabel('Switch User');

        $securityContext = $this->container->get('security.context');
        if ($securityContext->isGranted('ROLE_ALLOWED_TO_SWITCH') or $securityContext->isGranted('ROLE_PREVIOUS_ADMIN')) {
            // The current (may be switched) username.
            $username = $securityContext->getToken()->getUser()->getUsername();

            // The actual user, if switched, retrieve the correct one.
            $actualUser = $securityContext->getToken()->getUser();
            foreach ($securityContext->getToken()->getRoles() as $role) {
                if ($role instanceof SwitchUserRole) {
                    $actualUser = $role->getSource();
                    break;
                }
            }

            foreach (UserQuery::create()->find() as $eachUser) {
                // only show links to different users
                if ($username !== $eachUser->getUsername()) {
                    $menu->addChild($eachUser->getUsername(), array('uri' => '?_switch_user='.$eachUser->getUsername()));
                }
            }

            $menu->addChild($actualUser->getUsername(), array('uri' => '?_switch_user=_exit'));
        }

        return $menu;
    }

    protected function createMenuItem(FactoryInterface $factory, $item)
    {
        $options = array('label' => $item['display_name']);
        if(isset($item['uri']))
        {
            $options['uri'] = $item['uri'];
        }
        elseif(isset($item['route_name']))
        {
            $options['route'] = $item['route_name'];
        }

        $menuItem = $factory->createItem($item['name'], $options);
        if(isset($item['icon']))
        {
            $menuItem->setExtra('icon', $item['icon']);
        }

        return $menuItem;
    }

    protected function getMenuItems($user, array $options)
    {
        // $userLevel = $user->getLevel();
        $userLevel = 9;
        $doctrine = $this->container->get('doctrine');
        $connection = $doctrine->getConnection('default');
        $section = isset($options['section']) ? $options['section'] : 'default';

        $where = "enabled = 1 AND required_level <= {$userLevel} AND section='{$section}'";
        $mainMenuSql = "SELECT * FROM admin_menus WHERE {$where} ORDER BY weight ASC;";

        $menuItems = array();
        $subMenuItems = array();
        $menuCursor = $connection->executeQuery($mainMenuSql);
        foreach ($menuCursor as $item)
        {
            if(!isset($item['parent']) || null === $item['parent'])
            {
                $menuItems[$item['name']] = $item;
            }
            else
            {
                $subMenuItems[] = $item;
            }
        }

        foreach ($subMenuItems as $item)
        {
            if(isset($item['parent']) && null !== $item['parent'])
            {
                if(!isset($menuItems[$item['parent']]['children']))
                {
                    $menuItems[$item['parent']]['children'] = array();
                }

                $menuItems[$item['parent']]['children'][] = $item;
            }
        }

        return $menuItems;
    }

    protected function getCurrentUser()
    {
        $token = $this->container->get('security.context')->getToken();
        $user  = $token->getUser();

        return $user;
    }
}
