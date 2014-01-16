<?php

/* DreamHeavenAdminBundle::Settings/menus.html.twig */
class __TwigTemplate_023bed57bd9859534b146a634ba403c4 extends Twig_Template
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
        $context["tabs"] = array(0 => array("name" => "账户设置", "route" => "admin_settings_account_edit"));
        // line 10
        echo "  ";
        echo $this->env->getExtension('knp_menu')->render("DreamHeavenAdminBundle:TabBuilder:tabs", array("currentClass" => "active", "tabs" => (isset($context["tabs"]) ? $context["tabs"] : $this->getContext($context, "tabs")), "class" => "nav nav-list"));
        echo "
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::Settings/menus.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  30 => 10,  28 => 3,  26 => 2,  20 => 1,  83 => 19,  81 => 18,  77 => 17,  71 => 14,  65 => 10,  62 => 9,  55 => 6,  52 => 5,  21 => 3,  14 => 2,  125 => 69,  121 => 68,  117 => 67,  113 => 66,  109 => 65,  103 => 64,  94 => 57,  91 => 18,  43 => 10,  40 => 9,  35 => 6,  32 => 5,  27 => 3,);
    }
}
