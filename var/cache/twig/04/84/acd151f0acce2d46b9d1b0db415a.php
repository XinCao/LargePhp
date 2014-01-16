<?php

/* DreamHeavenAdminBundle::GameMaster/menus.html.twig */
class __TwigTemplate_0484acd151f0acce2d46b9d1b0db415a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sidebar_menu_body' => array($this, 'block_sidebar_menu_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('sidebar_menu_body', $context, $blocks);
    }

    public function block_sidebar_menu_body($context, array $blocks = array())
    {
        // line 2
        echo "  ";
        // line 3
        $context["menu"] = array("name" => "后台管理菜单", "items" => array(0 => array("label" => "总览", "route" => "admin_game_master_overview_index", "icon" => "icon-list", "access" => "ROLE_REPORTER"), 1 => array("label" => "服务器列表", "route" => "admin_game_master_realm_management_edit", "group" => "admin_game_master_realm_management", "icon" => "icon-th", "access" => "ROLE_MANAGER"), 2 => array("label" => "帐号管理", "route" => "admin_game_master_user_management_index", "group" => "admin_game_master_user_management", "icon" => "icon-user", "access" => "ROLE_MANAGER"), 3 => array("label" => "操作记录", "route" => "admin_game_master_operation_log_view_logs", "group" => "admin_game_master_operation_log_view", "icon" => "icon-list", "access" => "ROLE_MANAGER")));
        // line 37
        echo "  ";
        // line 52
        echo "  ";
        echo $this->env->getExtension('knp_menu')->render("DreamHeavenAdminBundle:MenuBuilder:build", array("currentClass" => "active", "menu" => $this->getContext($context, "menu")));
        echo "
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::GameMaster/menus.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  30 => 37,  28 => 3,  26 => 2,  20 => 1,  53 => 6,  50 => 5,  21 => 3,  14 => 2,  44 => 10,  40 => 8,  37 => 7,  32 => 52,  29 => 3,);
    }
}
