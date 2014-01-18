<?php

namespace DreamHeaven\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Security\Core\Role\SwitchUserRole;

class AccountMenuBuilder extends ContainerAware {

    public function mainMenu(FactoryInterface $factory) {
        $menu = $factory->createItem('root');
        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Dashboard', array(
            'uri' => '#',
        ));
        $menu->addChild('Demo View', array(
            'route' => 'demo',
        ));

        return $menu;
    }

    public function switchUserMenu(FactoryInterface $factory) {
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
                    $menu->addChild($eachUser->getUsername(), array('uri' => '?_switch_user=' . $eachUser->getUsername()));
                }
            }

            $menu->addChild($actualUser->getUsername(), array('uri' => '?_switch_user=_exit'));
        }

        return $menu;
    }

}