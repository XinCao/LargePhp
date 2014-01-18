<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appdevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appdevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        // _wdt
        if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::toolbarAction',)), array('_route' => '_wdt'));
        }

        if (0 === strpos($pathinfo, '/_profiler')) {
            // _profiler_search
            if ($pathinfo === '/_profiler/search') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchAction',  '_route' => '_profiler_search',);
            }

            // _profiler_purge
            if ($pathinfo === '/_profiler/purge') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::purgeAction',  '_route' => '_profiler_purge',);
            }

            // _profiler_info
            if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::infoAction',)), array('_route' => '_profiler_info'));
            }

            // _profiler_import
            if ($pathinfo === '/_profiler/import') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::importAction',  '_route' => '_profiler_import',);
            }

            // _profiler_export
            if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]+)\\.txt$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::exportAction',)), array('_route' => '_profiler_export'));
            }

            // _profiler_phpinfo
            if ($pathinfo === '/_profiler/phpinfo') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::phpinfoAction',  '_route' => '_profiler_phpinfo',);
            }

            // _profiler_search_results
            if (preg_match('#^/_profiler/(?P<token>[^/]+)/search/results$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchResultsAction',)), array('_route' => '_profiler_search_results'));
            }

            // _profiler
            if (preg_match('#^/_profiler/(?P<token>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::panelAction',)), array('_route' => '_profiler'));
            }

            // _profiler_redirect
            if (rtrim($pathinfo, '/') === '/_profiler') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_profiler_redirect');
                }

                return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => '_profiler_search_results',  'token' => 'empty',  'ip' => '',  'url' => '',  'method' => '',  'limit' => '10',  '_route' => '_profiler_redirect',);
            }

        }

        if (0 === strpos($pathinfo, '/_configurator')) {
            // _configurator_home
            if (rtrim($pathinfo, '/') === '/_configurator') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_configurator_home');
                }

                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
            }

            // _configurator_step
            if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',)), array('_route' => '_configurator_step'));
            }

            // _configurator_final
            if ($pathinfo === '/_configurator/final') {
                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
            }

        }

        if (0 === strpos($pathinfo, '/admin')) {
            // admin_dashboard
            if ($pathinfo === '/admin/dashboard') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_dashboard;
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\DashboardController::indexAction',  '_route' => 'admin_dashboard',);
            }
            not_admin_dashboard:

            // admin_dashboard_alt
            if (rtrim($pathinfo, '/') === '/admin') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_dashboard_alt;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_dashboard_alt');
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\DashboardController::indexAction',  '_route' => 'admin_dashboard_alt',);
            }
            not_admin_dashboard_alt:

            // admin_session_login
            if ($pathinfo === '/admin/login') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_session_login;
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\Security\\SessionController::loginAction',  '_route' => 'admin_session_login',);
            }
            not_admin_session_login:

            // admin_session_login_check
            if ($pathinfo === '/admin/login-check') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_session_login_check;
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\Security\\SessionController::loginCheckAction',  '_route' => 'admin_session_login_check',);
            }
            not_admin_session_login_check:

            // admin_session_logout
            if ($pathinfo === '/admin/logout') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_session_logout;
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\Security\\SessionController::logoutAction',  '_route' => 'admin_session_logout',);
            }
            not_admin_session_logout:

            // admin_session_access_denied
            if ($pathinfo === '/admin/access-denied') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_session_access_denied;
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\Security\\SessionController::accessDeniedAction',  '_route' => 'admin_session_access_denied',);
            }
            not_admin_session_access_denied:

            // admin_settings_account_edit
            if ($pathinfo === '/admin/settings/account') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_settings_account_edit;
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\Settings\\AccountController::editAction',  '_route' => 'admin_settings_account_edit',);
            }
            not_admin_settings_account_edit:

            // admin_settings_account_update
            if ($pathinfo === '/admin/settings/account') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_settings_account_update;
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\Settings\\AccountController::updateAction',  '_route' => 'admin_settings_account_update',);
            }
            not_admin_settings_account_update:

            // admin_game_master_overview_index
            if ($pathinfo === '/admin/game-master/overview') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_game_master_overview_index;
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\OverviewController::indexAction',  '_route' => 'admin_game_master_overview_index',);
            }
            not_admin_game_master_overview_index:

            // admin_game_master_realm_management_edit
            if ($pathinfo === '/admin/game-master/realms/edit') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_admin_game_master_realm_management_edit;
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\RealmManagementController::editAction',  '_route' => 'admin_game_master_realm_management_edit',);
            }
            not_admin_game_master_realm_management_edit:

            // admin_game_master_user_management_index
            if ($pathinfo === '/admin/game-master/users') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_game_master_user_management_index;
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\UserManagementController::indexAction',  '_route' => 'admin_game_master_user_management_index',);
            }
            not_admin_game_master_user_management_index:

            // admin_game_master_user_management_new
            if ($pathinfo === '/admin/game-master/users/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_game_master_user_management_new;
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\UserManagementController::newAction',  '_route' => 'admin_game_master_user_management_new',);
            }
            not_admin_game_master_user_management_new:

            // admin_game_master_user_management_edit
            if (0 === strpos($pathinfo, '/admin/game-master/users/edit') && preg_match('#^/admin/game\\-master/users/edit/(?P<id>[0-9]+)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_game_master_user_management_edit;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\UserManagementController::editAction',)), array('_route' => 'admin_game_master_user_management_edit'));
            }
            not_admin_game_master_user_management_edit:

            // admin_game_master_user_management_create
            if ($pathinfo === '/admin/game-master/users') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_game_master_user_management_create;
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\UserManagementController::createAction',  '_route' => 'admin_game_master_user_management_create',);
            }
            not_admin_game_master_user_management_create:

            // admin_game_master_user_management_update
            if (0 === strpos($pathinfo, '/admin/game-master/users') && preg_match('#^/admin/game\\-master/users/(?P<id>[0-9]+)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_admin_game_master_user_management_update;
                }

                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\UserManagementController::updateAction',)), array('_route' => 'admin_game_master_user_management_update'));
            }
            not_admin_game_master_user_management_update:

            // admin_game_master_operation_log_view_logs
            if ($pathinfo === '/admin/game-master/operation-logs') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_game_master_operation_log_view_logs;
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameMaster\\OperationLogViewController::logsAction',  '_route' => 'admin_game_master_operation_log_view_logs',);
            }
            not_admin_game_master_operation_log_view_logs:

            // admin_game_management_overview_index
            if ($pathinfo === '/admin/game-management/overview') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_game_management_overview_index;
                }

                return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameManagement\\OverviewController::indexAction',  '_route' => 'admin_game_management_overview_index',);
            }
            not_admin_game_management_overview_index:

        }

        // admin_game_management_server_info_index
        if ($pathinfo === '/server-info') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_admin_game_management_server_info_index;
            }

            return array (  '_controller' => 'DreamHeaven\\AdminBundle\\Controller\\GameManagement\\ServerInfoController::indexAction',  '_route' => 'admin_game_management_server_info_index',);
        }
        not_admin_game_management_server_info_index:

        // admin_game_management_current_recharge_index
        if ($pathinfo === '/current-recharge/index') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_admin_game_management_current_recharge_index;
            }

            return array (  '_controller' => 'DreamHeavenAdminBundle:GameManagement\\CurrentRecharge:index',  '_route' => 'admin_game_management_current_recharge_index',);
        }
        not_admin_game_management_current_recharge_index:

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
