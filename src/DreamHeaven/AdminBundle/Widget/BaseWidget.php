<?php
namespace DreamHeaven\AdminBundle\Widget;

use Symfony\Component\DependencyInjection\ContainerAware;
use FOS\UserBundle\Model\User;
use DreamHeaven\HuashuoBundle\Document\Profile;

abstract class BaseWidget extends ContainerAware
{
    protected $options = array();

    /** @var \DreamHeaven\HuashuoBundle\Document\Profile */
    protected $currentUser = false;

    abstract public function render();

    public function init($options)
    {
        $options = array_merge($this->options, $options);
    }

    protected function renderView($view, array $parameters = array())
    {
        // $view = "DreamHeavenAdminBundle::{$view}.html.twig";
        return $this->container->get('templating')->render($view, $parameters);
    }

    /** @return \DreamHeaven\HuashuoBundle\Document\Profile */
    public function getCurrentUser()
    {
        if($this->currentUser !== false)
        {
            return $this->currentUser;
        }

        if(!$user = $this->getCurrentUserAccount())
        {
            $this->currentUser = null;
            return null;
        }

        $user = $this->getCurrentUserAccount();
        $this->currentUser = $user;

        return $this->currentUser;
    }

    /**
     * @return User
     */
    public function getCurrentUserAccount()
    {
        $securityContext = $this->container->get('security.context');
        $token = $securityContext->getToken();
        if(!$token || !$securityContext->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            return null;
        }

        $user = $token->getUser();

        return $user;
    }
}
