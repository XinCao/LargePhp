<?php

/* DreamHeavenAdminBundle::GameMaster/UserManagement/tabs.html.twig */
class __TwigTemplate_43619dc1bfda7b8396484acfb22aa329 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'tabs' => array($this, 'block_tabs'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('tabs', $context, $blocks);
    }

    public function block_tabs($context, array $blocks = array())
    {
        // line 3
        $context["tabs"] = array(0 => array("name" => "用户列表", "route" => "admin_game_master_user_management_index", "icon" => "icon-list"), 1 => array("name" => "创建用户", "icon" => "icon-plus", "route" => "admin_game_master_user_management_new"));
        // line 16
        if (($this->getContext($context, "current_route") == "admin_game_master_user_management_edit")) {
            // line 17
            echo "  ";
            $context["edit_tab"] = array(0 => array("name" => "编辑用户", "icon" => "icon-edit", "route" => "admin_game_master_user_management_edit", "routeParameters" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "attributes"), "get", array(0 => "_route_params"), "method")));
            // line 26
            echo "  ";
            $context["tabs"] = twig_array_merge($this->getContext($context, "tabs"), $this->getContext($context, "edit_tab"));
        }
        // line 28
        echo "<div class=\"row-fluid\">
    ";
        // line 29
        echo $this->env->getExtension('knp_menu')->render("DreamHeavenAdminBundle:TabBuilder:tabs", array("currentClass" => "active", "tabs" => $this->getContext($context, "tabs")));
        echo "
</div>
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::GameMaster/UserManagement/tabs.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  33 => 26,  30 => 17,  28 => 16,  26 => 3,  20 => 1,  101 => 33,  92 => 30,  88 => 29,  84 => 28,  80 => 27,  76 => 26,  70 => 25,  66 => 24,  63 => 23,  59 => 22,  45 => 10,  43 => 9,  40 => 29,  37 => 28,  32 => 4,  29 => 3,);
    }
}
