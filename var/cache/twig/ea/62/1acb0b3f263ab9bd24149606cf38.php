<?php

/* DreamHeavenAdminBundle::layout-GameManagement.html.twig */
class __TwigTemplate_ea621acb0b3f263ab9bd24149606cf38 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DreamHeavenAdminBundle::layout-Base.html.twig");

        $_trait_0 = $this->env->loadTemplate("DreamHeavenAdminBundle::Shared/sidebarMenu.html.twig");
        // line 2
        if (!$_trait_0->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."DreamHeavenAdminBundle::Shared/sidebarMenu.html.twig".'" cannot be used as a trait.');
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $_trait_1 = $this->env->loadTemplate("DreamHeavenAdminBundle::GameManagement/menus.html.twig");
        // line 3
        if (!$_trait_1->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."DreamHeavenAdminBundle::GameManagement/menus.html.twig".'" cannot be used as a trait.');
        }
        $_trait_1_blocks = $_trait_1->getBlocks();

        $this->traits = array_merge(
            $_trait_0_blocks,
            $_trait_1_blocks
        );

        $this->blocks = array_merge(
            $this->traits,
            array(
                'sidebar' => array($this, 'block_sidebar'),
            )
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

    // line 5
    public function block_sidebar($context, array $blocks = array())
    {
        // line 6
        echo "  ";
        $this->displayBlock("sidebar_menu", $context, $blocks);
        echo "
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::layout-GameManagement.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 6,  50 => 5,  21 => 3,  14 => 2,  127 => 87,  124 => 86,  67 => 32,  41 => 8,  38 => 7,  33 => 4,  30 => 3,);
    }
}
