<?php

/* DreamHeavenAdminBundle::layout-Dashboard.html.twig */
class __TwigTemplate_ec76948583a7e08c467d6a9217718c47 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DreamHeavenAdminBundle::layout-Base.html.twig");

        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "DreamHeavenAdminBundle::layout-Base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::layout-Dashboard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 18,  67 => 15,  63 => 13,  60 => 12,  53 => 9,  50 => 8,  45 => 5,  42 => 4,  14 => 2,);
    }
}
