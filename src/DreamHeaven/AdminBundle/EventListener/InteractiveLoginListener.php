<?php
namespace DreamHeaven\AdminBundle\EventListener;

use FOS\UserBundle\Model\UserManagerInterface;
use DreamHeaven\HuashuoBundle\Document\Profile;
use Doctrine\ODM\MongoDB\DocumentManager;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

class InteractiveLoginListener
{
    /** @var ContainerInterface */
    protected $container;
    /** @var DocumentManager */
    protected $dm;
    /** @var LoggerInterface */
    protected $logger;

    public function __construct(ContainerInterface $container, DocumentManager $dm, LoggerInterface $logger)
    {
        $this->container = $container;
        $this->dm        = $dm;
        $this->logger    = $logger;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
//        $user = $event->getAuthenticationToken()->getUser();
//
//        $userId = (string)$user->getId();
//        $profile = $this->dm->find(Profile::CLASS_NAME, $userId);
//
//        $token = $event->getAuthenticationToken();
//        $token->setAttribute('user.id', $userId);
//        $token->setAttribute('profile.name', $profile->name);
//        $attrs = $token->getAttributes();
    }
}
