<?php

/* DreamHeavenAdminBundle:GameMaster/OperationLogView:logs.html.twig */
class __TwigTemplate_cd98335bb20691e593b64332388d321b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DreamHeavenAdminBundle::layout-GameMaster.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'main_content' => array($this, 'block_main_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "DreamHeavenAdminBundle::layout-GameMaster.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["fluid_layout"] = true;
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        // line 5
        echo "操作记录查看 | 游戏管理
";
    }

    // line 8
    public function block_main_content($context, array $blocks = array())
    {
        // line 9
        echo "
  ";
        // line 10
        $this->env->loadTemplate("DreamHeavenAdminBundle::Shared/operationLogs.html.twig")->display($context);
        // line 11
        echo "
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle:GameMaster/OperationLogView:logs.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 11,  45 => 10,  42 => 9,  39 => 8,  34 => 5,  31 => 4,  26 => 1,);
    }
}
