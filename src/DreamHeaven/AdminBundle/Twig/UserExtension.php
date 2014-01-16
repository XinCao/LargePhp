<?php
namespace DreamHeaven\AdminBundle\Twig;

use stdClass;
use Twig_Extension;
use DreamHeaven\HuashuoBundle\Document\Profile;
use Twig_Filter_Method;
use Twig_Function_Method;

use Symfony\Component\Security\Core\Role\SwitchUserRole;

class UserExtension extends Twig_Extension
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getGlobals()
    {
        $sec = $this->container->get('security.context');
        $token = $sec->getToken();

        if(!$token || !$sec->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            return array();
        }

        $globals = array();
        if($currentUserProfile = $this->getCurrentUserProfile($sec))
        {
            $globals['current_user'] = $currentUserProfile;
        }

        if($impersonatedUserProfile = $this->getImpersonatedUserProfile($sec))
        {
            $globals['impersonator'] = $impersonatedUserProfile;
        }

        return $globals;
    }

    protected function getCurrentUserProfile($sec)
    {
        $user = $sec->getToken()->getUser();
        if(!$user)
        {
            return null;
        }

        return $user;
    }

    protected function getImpersonatedUserProfile($sec)
    {
        if (!$sec->isGranted('ROLE_PREVIOUS_ADMIN'))
        {
            return null;
        }

        foreach ($sec->getToken()->getRoles() as $role)
        {
            if ($role instanceof SwitchUserRole)
            {
                $adminUser = $role->getSource()->getUser();
                return $adminUser;
            }
        }
    }

    public function getName()
    {
        return 'user_extension';
    }
}
