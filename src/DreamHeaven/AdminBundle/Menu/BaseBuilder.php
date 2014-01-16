<?php
namespace DreamHeaven\AdminBundle\Menu;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class BaseBuilder extends ContainerAware {
    protected function isCurrent($item) {
        $currentPath  = $this->container->get('request')->getPathInfo();
        $currentRoute = $this->container->get('request')->get('_route');

        if((isset($item['uri']) && $item['uri'] == $currentPath) || (isset($item['route']) && $item['route'] == $currentRoute)) {
            return true;
        }
        elseif(isset($item['group'])) {
            $prefixLen = strlen($item['group']);
            if((isset($item['uri']) && substr($item['uri'], 0, $prefixLen) == substr($currentPath, 0, $prefixLen)) 
                    || 
                (isset($item['route']) && substr($item['route'], 0, $prefixLen) == substr($currentRoute, 0, $prefixLen))){
                return true;
            }
        }
        return false;
    }

    protected function isAccessable($item) {
        if((isset($item['enabled']) && !$item['enabled'])) {
            return false;
        }
        if(!isset($item['access']) || !$item['access']) {
            return true;
        }
        $token = $this->container->get('security.context')->getToken();
        $user  = $token->getUser();
        $accessableRoles = (array)$item['access'];
        foreach ($accessableRoles as $role) {
            if($user->hasRole($role)) {
                return true;
            }
        }
        return false;
    }
}
