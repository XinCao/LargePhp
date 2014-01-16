<?php
namespace DreamHeaven\AdminBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\HttpUtils;

class AdminLoginRedirector implements AuthenticationSuccessHandlerInterface {

    /** @var SecurityContext */
    protected $security;
    protected $httpUtils;
    
    public function __construct(SecurityContext $security, HttpUtils $httpUtils) {
        $this->security = $security;
        $this->httpUtils = $httpUtils;
    }

    /**
     * {@inheritDoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
        $url = '/admin/game-management/overview';
//        if($this->security->isGranted('ROLE_REPORT_VIEWER')) {
//            $url = 'admin_operation_report_overview_report_daily_report';
//        }
        return $this->httpUtils->createRedirectResponse($request, $url);
    }

}