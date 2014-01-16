<?php
namespace DreamHeaven\AdminBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\UserManager;

class AdminAccountProvider implements UserProviderInterface
{
    protected $container;
    protected $dm;
    protected $logger;

    public function __construct(ContainerInterface $container, UserManager $userManager, LoggerInterface $logger = null)
    {
        $this->container   = $container;
        $this->userManager = $userManager;
        $this->logger      = $logger;
    }

    /**
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @throws UsernameNotFoundException if the user is not found
     * @param string $username The username
     *
     * @return UserInterface
     */
    public function loadUserByUsername($username)
    {
        $user = $this->userManager->loadUserByUsername($username);
        return $user;
    }

    /**
     * Loads the user for the account interface.
     *
     * It is up to the implementation if it decides to reload the user data
     * from the database, or if it simply merges the passed User into the
     * identity map of an entity manager.
     *
     * @throws UnsupportedUserException if the account is not supported
     * @param UserInterface $user
     *
     * @return UserInterface
     */
    public function loadUser(UserInterface $user)
    {
        $user = $this->userManager->loadUser($user);
        return $user;
    }

    /**
     * Whether this provider supports the given user class
     *
     * @param string $class
     *
     * @return Boolean
     */
    public function supportsClass($class)
    {
        return $this->userManager->supportsClass($class);
    }

    public function refreshUser(UserInterface $user)
    {

    }
}
