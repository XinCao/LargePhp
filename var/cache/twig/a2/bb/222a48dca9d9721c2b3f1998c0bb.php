<?php

/* DreamHeavenAdminBundle::layout-GameMaster.html.twig */
class __TwigTemplate_a2bb222a48dca9d9721c2b3f1998c0bb extends Twig_Template
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

        $_trait_1 = $this->env->loadTemplate("DreamHeavenAdminBundle::GameMaster/menus.html.twig");
        // line 3
        if (!$_trait_1->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."DreamHeavenAdminBundle::GameMaster/menus.html.twig".'" cannot be used as a trait.');
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
        return "DreamHeavenAdminBundle::layout-GameMaster.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 6,  50 => 5,  21 => 3,  14 => 2,  44 => 10,  40 => 8,  37 => 7,  32 => 4,  29 => 3,);
    }
}
