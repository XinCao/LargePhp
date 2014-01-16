<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DreamHeaven\CoreBundle\Service;

use Symfony\Component\HttpKernel\Log\LoggerInterface;
use DreamHeaven\CoreBundle\Document\UserApplication;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Entity\UserManager;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AuthenticationManager extends Service
{
    /** @var EntityManager */
    protected $em;

    /** @var UserManager */
    protected $userManager;

    /** @var AuthenticationManagerInterface */
    protected $authenticationManager;
    
    protected $logger;

    public function __construct(SecurityContextInterface $securityContext,
                                AuthenticationManagerInterface $authenticationManager,
                                AuthenticationEntryPointInterface $authenticationEntryPoint,
                                UserManager $userManager,
                                EntityManager $em,
                                LoggerInterface $logger = null, $options = array())
    {
        $this->userManager = $userManager;
        $this->authenticationManager = $authenticationManager;
        $this->em = $em;
        $this->logger = $logger;
    }

    /**
     *
     * @param type $username
     * @param type $password
     * @return \FOS\UserBundle\Entity\User
     */
    public function validateCredentials($username, $password)
    {
        
    }

    /**
     *
     * @param type $username
     * @param type $password
     * @return \FOS\UserBundle\Entity\User
     */
    public function authenticate($username, $password)
    {
        $user = $this->validateCredentials($username, $password);
        if(!$user)
        {
            return false;
        }

        $token = new UsernamePasswordToken($user, $credentials, $providerKey);
        $user = $this->authenticationManager->authenticate($token);
        $this->storeAuthenticationToken($user);
    }

    abstract public function storeAuthenticationToken($user, $token);
}
