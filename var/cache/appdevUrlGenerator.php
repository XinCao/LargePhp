<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * appdevUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appdevUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    static private $declaredRoutes = array(
        '_wdt' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::toolbarAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]+',      3 => 'token',    ),    1 =>     array (      0 => 'text',      1 => '/_wdt',    ),  ),),
        '_profiler_search' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/search',    ),  ),),
        '_profiler_purge' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::purgeAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/purge',    ),  ),),
        '_profiler_info' => array (  0 =>   array (    0 => 'about',  ),  1 =>   array (    '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::infoAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]+',      3 => 'about',    ),    1 =>     array (      0 => 'text',      1 => '/_profiler/info',    ),  ),),
        '_profiler_import' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::importAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/import',    ),  ),),
        '_profiler_export' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::exportAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '.txt',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/\\.]+',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler/export',    ),  ),),
        '_profiler_phpinfo' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::phpinfoAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/phpinfo',    ),  ),),
        '_profiler_search_results' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchResultsAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/search/results',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]+',      3 => 'token',    ),    2 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),),
        '_profiler' => array (  0 =>   array (    0 => 'token',  ),  1 =>   array (    '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::panelAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]+',      3 => 'token',    ),    1 =>     array (      0 => 'text',      1 => '/_profiler',    ),  ),),
        '_profiler_redirect' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',    'route' => '_profiler_search_results',    'token' => 'empty',    'ip' => '',    'url' => '',    'method' => '',    'limit' => '10',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_profiler/',    ),  ),),
        '_configurator_home' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_configurator/',    ),  ),),
        '_configurator_step' => array (  0 =>   array (    0 => 'index',  ),  1 =>   array (    '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]+',      3 => 'index',    ),    1 =>     array (      0 => 'text',      1 => '/_configurator/step',    ),  ),),
        '_configurator_final' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/_configurator/final',    ),  ),),
        'admin_dashboard' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\DashboardController::indexAction',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/dashboard',    ),  ),),
        'admin_dashboard_alt' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\DashboardController::indexAction',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/',    ),  ),),
        'admin_session_login' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\Security\\SessionController::loginAction',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/login',    ),  ),),
        'admin_session_login_check' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\Security\\SessionController::loginCheckAction',  ),  2 =>   array (    '_method' => 'POST',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/login-check',    ),  ),),
        'admin_session_logout' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\Security\\SessionController::logoutAction',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/logout',    ),  ),),
        'admin_session_access_denied' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\Security\\SessionController::accessDeniedAction',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/access-denied',    ),  ),),
        'admin_settings_account_edit' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\Settings\\AccountController::editAction',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/settings/account',    ),  ),),
        'admin_settings_account_update' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\Settings\\AccountController::updateAction',  ),  2 =>   array (    '_method' => 'POST',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/settings/account',    ),  ),),
        'admin_game_master_overview_index' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\OverviewController::indexAction',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/game-master/overview',    ),  ),),
        'admin_game_master_realm_management_edit' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\RealmManagementController::editAction',  ),  2 =>   array (    '_method' => 'GET|POST',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/game-master/realms/edit',    ),  ),),
        'admin_game_master_user_management_index' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\UserManagementController::indexAction',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/game-master/users',    ),  ),),
        'admin_game_master_user_management_new' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\UserManagementController::newAction',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/game-master/users/new',    ),  ),),
        'admin_game_master_user_management_edit' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\UserManagementController::editAction',  ),  2 =>   array (    '_method' => 'GET',    'id' => '[0-9]+',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[0-9]+',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/admin/game-master/users/edit',    ),  ),),
        'admin_game_master_user_management_create' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\UserManagementController::createAction',  ),  2 =>   array (    '_method' => 'POST',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/game-master/users',    ),  ),),
        'admin_game_master_user_management_update' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\UserManagementController::updateAction',  ),  2 =>   array (    '_method' => 'PUT',    'id' => '[0-9]+',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[0-9]+',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/admin/game-master/users',    ),  ),),
        'admin_game_master_operation_log_view_logs' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\OperationLogViewController::logsAction',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/game-master/operation-logs',    ),  ),),
        'admin_game_management_overview_index' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameManagement\\OverviewController::indexAction',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/game-management/overview',    ),  ),),
        'admin_game_management_server_info_index' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameManagement\\ServerInfoController::indexAction',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/server-info',    ),  ),),
        'admin_game_management_current_recharge_index' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'DreamHeavenAdminBundle:GameManagement\\CurrentRecharge:index',  ),  2 =>   array (    '_method' => 'GET',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/current-recharge/index',    ),  ),),
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
    }

    public function generate($name, $parameters = array(), $absolute = false)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Route "%s" does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $absolute);
    }
}
