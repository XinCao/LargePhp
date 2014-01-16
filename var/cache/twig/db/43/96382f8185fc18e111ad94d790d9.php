<?php

/* DreamHeavenAdminBundle::Widgets/Hello/index.html.twig */
class __TwigTemplate_db4396382f8185fc18e111ad94d790d9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DreamHeavenAdminBundle::Widgets/base.html.twig");

        $this->blocks = array(
            'widget_header' => array($this, 'block_widget_header'),
            'widget_body' => array($this, 'block_widget_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "DreamHeavenAdminBundle::Widgets/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_widget_header($context, array $blocks = array())
    {
        // line 4
        echo "<i class=\"icon-file\"></i>
Hello, Title
";
    }

    // line 8
    public function block_widget_body($context, array $blocks = array())
    {
        // line 9
        echo "    Hello, Widget!
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::Widgets/Hello/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 9,  38 => 8,  32 => 4,  29 => 3,  73 => 18,  67 => 15,  63 => 13,  60 => 12,  53 => 9,  50 => 8,  45 => 5,  42 => 4,  14 => 2,);
    }
}
