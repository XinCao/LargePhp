<?php

/* DreamHeavenAdminBundle::layout-Base.html.twig */
class __TwigTemplate_3533d4f3535a2d3a57cf7ec721eb71bf extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $_trait_0 = $this->env->loadTemplate("DreamHeavenAdminBundle::Shared/header.html.twig");
        // line 6
        if (!$_trait_0->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."DreamHeavenAdminBundle::Shared/header.html.twig".'" cannot be used as a trait.');
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $_trait_1 = $this->env->loadTemplate("DreamHeavenAdminBundle::Shared/footer.html.twig");
        // line 7
        if (!$_trait_1->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."DreamHeavenAdminBundle::Shared/footer.html.twig".'" cannot be used as a trait.');
        }
        $_trait_1_blocks = $_trait_1->getBlocks();

        $_trait_2 = $this->env->loadTemplate("DreamHeavenAdminBundle::Shared/flashMessage.html.twig");
        // line 8
        if (!$_trait_2->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."DreamHeavenAdminBundle::Shared/flashMessage.html.twig".'" cannot be used as a trait.');
        }
        $_trait_2_blocks = $_trait_2->getBlocks();

        $this->traits = array_merge(
            $_trait_0_blocks,
            $_trait_1_blocks,
            $_trait_2_blocks
        );

        $this->blocks = array_merge(
            $this->traits,
            array(
                'container' => array($this, 'block_container'),
                'main_content' => array($this, 'block_main_content'),
            )
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["current_platform"] = $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "get", array(0 => "platform"), "method");
        // line 2
        $context["current_route"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "attributes"), "get", array(0 => "_route"), "method");
        // line 3
        $context["current_route_params"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "attributes"), "get", array(0 => "_route_params"), "method");
        // line 4
        $context["is_dev"] = ($this->getAttribute($this->getContext($context, "app"), "environment") == "dev");
        // line 9
        ob_start();
        // line 10
        $this->displayBlock("doc_header", $context, $blocks);
        echo "
";
        // line 11
        $this->displayBlock("header", $context, $blocks);
        echo "

";
        // line 13
        $this->displayBlock('container', $context, $blocks);
        // line 28
        echo "
";
        // line 29
        $this->displayBlock("footer", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 13
    public function block_container($context, array $blocks = array())
    {
        // line 14
        echo "  <section id=\"content\">
  <div class=\"container";
        // line 15
        echo ((array_key_exists("fluid_layout", $context)) ? ("-fluid") : (""));
        echo "\">
      <div class=\"row";
        // line 16
        echo ((array_key_exists("fluid_layout", $context)) ? ("-fluid") : (""));
        echo "\">
          <div class=\"";
        // line 17
        echo ((array_key_exists("fluid_layout", $context)) ? ("span2") : ("span3"));
        echo "\">
              ";
        // line 18
        $this->displayBlock("sidebar", $context, $blocks);
        echo "
          </div>
          <div class=\"";
        // line 20
        echo ((array_key_exists("fluid_layout", $context)) ? ("span10") : ("span9"));
        echo "\" id=\"main_content_span\">
              ";
        // line 21
        $this->displayBlock("flash_message", $context, $blocks);
        echo "
              ";
        // line 22
        $this->displayBlock('main_content', $context, $blocks);
        // line 23
        echo "          </div>
      </div>
  </div>
  </section>
";
    }

    // line 22
    public function block_main_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::layout-Base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  123 => 22,  115 => 23,  113 => 22,  109 => 21,  105 => 20,  100 => 18,  96 => 17,  92 => 16,  88 => 15,  85 => 14,  82 => 13,  75 => 29,  72 => 28,  70 => 13,  65 => 11,  61 => 10,  59 => 9,  57 => 4,  55 => 3,  51 => 1,  28 => 8,  53 => 2,  50 => 5,  21 => 7,  14 => 6,  127 => 87,  124 => 86,  67 => 32,  41 => 8,  38 => 7,  33 => 4,  30 => 3,);
    }
}
