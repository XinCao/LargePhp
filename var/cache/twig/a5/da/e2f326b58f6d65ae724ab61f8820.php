<?php

/* DreamHeavenAdminBundle:GameMaster/Overview:index.html.twig */
class __TwigTemplate_a5dae2f326b58f6d65ae724ab61f8820 extends Twig_Template
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        // line 4
        echo "总览 | 后台管理
";
    }

    // line 7
    public function block_main_content($context, array $blocks = array())
    {
        // line 8
        echo "<div class=\"row-fluid\">
    <div class=\"span8\">
        ";
        // line 10
        echo $this->env->getExtension('widget_extension')->renderWidget("UserInfo");
        echo "
    </div>
    <!--/span-->
</div>
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle:GameMaster/Overview:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 10,  40 => 8,  37 => 7,  32 => 4,  29 => 3,);
    }
}
