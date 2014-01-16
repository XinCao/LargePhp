<?php

/* DreamHeavenAdminBundle::GameManagement/menus.html.twig */
class __TwigTemplate_659b85f1eb35459d57ef401b93675b32 extends Twig_Template
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
        $context["menu"] = array("name" => "游戏管理菜单", "items" => array(0 => array("label" => "服务器总览", "route" => "admin_game_management_overview_index", "icon" => "icon-eye-open", "access" => "ROLE_GM")));
        // line 16
        echo "  ";
        echo $this->env->getExtension('knp_menu')->render("DreamHeavenAdminBundle:MenuBuilder:build", array("currentClass" => "active", "menu" => $this->getContext($context, "menu")));
        echo "
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::GameManagement/menus.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  52 => 10,  43 => 10,  35 => 5,  45 => 12,  31 => 4,  32 => 5,  26 => 2,  20 => 1,  367 => 157,  363 => 156,  358 => 154,  354 => 153,  348 => 150,  344 => 149,  339 => 146,  334 => 143,  328 => 142,  318 => 140,  315 => 139,  312 => 138,  308 => 137,  305 => 136,  299 => 135,  292 => 131,  289 => 130,  286 => 129,  282 => 128,  279 => 127,  276 => 126,  273 => 125,  270 => 124,  262 => 162,  260 => 124,  254 => 121,  251 => 120,  247 => 111,  240 => 107,  233 => 104,  229 => 102,  227 => 101,  216 => 93,  213 => 92,  210 => 91,  206 => 86,  203 => 85,  199 => 84,  196 => 83,  191 => 10,  185 => 87,  182 => 85,  180 => 83,  119 => 31,  111 => 29,  107 => 28,  103 => 27,  99 => 26,  95 => 25,  91 => 24,  87 => 23,  83 => 22,  79 => 21,  71 => 16,  63 => 17,  47 => 10,  37 => 6,  34 => 5,  27 => 2,  25 => 1,  123 => 32,  115 => 30,  113 => 22,  109 => 21,  105 => 20,  100 => 18,  96 => 17,  92 => 16,  88 => 15,  85 => 14,  82 => 13,  75 => 20,  72 => 28,  70 => 13,  65 => 15,  61 => 10,  59 => 16,  57 => 4,  55 => 11,  51 => 1,  28 => 3,  53 => 2,  50 => 10,  21 => 1,  14 => 6,  127 => 33,  124 => 86,  67 => 18,  41 => 8,  38 => 7,  33 => 4,  30 => 16,);
    }
}
