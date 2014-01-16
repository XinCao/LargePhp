<?php

/* DreamHeavenAdminBundle:Dashboard:index.html.twig */
class __TwigTemplate_be3764bf50653e6ddfb7605b58608423 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DreamHeavenAdminBundle::layout-Dashboard.html.twig");

        $_trait_0 = $this->env->loadTemplate("DreamHeavenAdminBundle::Shared/sidebarMenu.html.twig");
        // line 2
        if (!$_trait_0->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."DreamHeavenAdminBundle::Shared/sidebarMenu.html.twig".'" cannot be used as a trait.');
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $this->traits = $_trait_0_blocks;

        $this->blocks = array_merge(
            $this->traits,
            array(
                'title' => array($this, 'block_title'),
                'sidebar' => array($this, 'block_sidebar'),
                'main_content' => array($this, 'block_main_content'),
            )
        );
    }

    protected function doGetParent(array $context)
    {
        return "DreamHeavenAdminBundle::layout-Dashboard.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        // line 5
        echo "首页 | 摩卡世界运营系统
";
    }

    // line 8
    public function block_sidebar($context, array $blocks = array())
    {
        // line 9
        echo "  ";
        $this->displayBlock("sidebar_menu", $context, $blocks);
        echo "
";
    }

    // line 12
    public function block_main_content($context, array $blocks = array())
    {
        // line 13
        echo "<div class=\"row-fluid\">
    <div class=\"span3\">
        ";
        // line 15
        echo $this->env->getExtension('widget_extension')->renderWidget("UserInfo");
        echo "
    </div>
    <div class=\"span3\">
        ";
        // line 18
        echo $this->env->getExtension('widget_extension')->renderWidget("Hello");
        echo "
    </div>
    <!--/span-->
</div>
<!--/row-->
<!--/span-->
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle:Dashboard:index.html.twig";
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
