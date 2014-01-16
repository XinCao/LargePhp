<?php
namespace DreamHeaven\AdminBundle\Widget;

use Symfony\Component\DependencyInjection\ContainerAware;

class UserInfoWidget extends BaseWidget
{
    public function init($options = array())
    {
    }

    public function render()
    {
        $currentUser = $this->getCurrentUser();
        $data = array(
            'user_id'   => $currentUser->id,
            'username'  => $currentUser->username,
            'name'      => $currentUser->display_name,
            'roles'     => $currentUser->getRoles(),
            'last_login' => $currentUser->getLastLogin()->getTimestamp(),
        );

        return $this->renderView('DreamHeavenAdminBundle::Widgets/UserInfo/index.html.twig', $data);
    }

    protected function getRoles()
    {
        $securityContext = $this->container->get('security.context');
        $token = $securityContext->getToken();
        $user = $token->getUser();
        return $user->getRoles();
    }
}
