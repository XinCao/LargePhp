<?php

/* DreamHeavenAdminBundle::Settings/layout.html.twig */
class __TwigTemplate_9b4193d6f85160fb858acf62b2bb5e99 extends Twig_Template
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

        $_trait_1 = $this->env->loadTemplate("DreamHeavenAdminBundle::Settings/menus.html.twig");
        // line 3
        if (!$_trait_1->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."DreamHeavenAdminBundle::Settings/menus.html.twig".'" cannot be used as a trait.');
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
                'container' => array($this, 'block_container'),
                'main_content' => array($this, 'block_main_content'),
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

    // line 9
    public function block_container($context, array $blocks = array())
    {
        // line 10
        echo "  <section id=\"content\">
  <div class=\"container\">
      <div class=\"row\">
          <div class=\"span3\">
              ";
        // line 14
        $this->displayBlock("sidebar", $context, $blocks);
        echo "
          </div>
          <div class=\"span8\" id=\"main_content_span\">
              ";
        // line 17
        $this->displayBlock("flash_message", $context, $blocks);
        echo "
              ";
        // line 18
        $this->displayBlock('main_content', $context, $blocks);
        // line 19
        echo "          </div>
      </div>
  </div>
  </section>
";
    }

    // line 18
    public function block_main_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::Settings/layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 19,  81 => 18,  77 => 17,  71 => 14,  65 => 10,  62 => 9,  55 => 6,  52 => 5,  21 => 3,  14 => 2,  125 => 69,  121 => 68,  117 => 67,  113 => 66,  109 => 65,  103 => 64,  94 => 57,  91 => 18,  43 => 10,  40 => 9,  35 => 6,  32 => 5,  27 => 3,);
    }
}
