<?php

/* DreamHeavenAdminBundle::Widgets/base.html.twig */
class __TwigTemplate_0b64fdd2b531de4b2a21e40ca7c59cbf extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'widget_header' => array($this, 'block_widget_header'),
            'widget_body' => array($this, 'block_widget_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"widget\">
    <div class=\"widget-header\">
        ";
        // line 3
        $this->displayBlock('widget_header', $context, $blocks);
        // line 7
        echo "    </div> <!-- /widget-header -->
    <div class=\"widget-content\">
        ";
        // line 9
        $this->displayBlock('widget_body', $context, $blocks);
        // line 10
        echo "    </div> <!-- /widget-content -->
</div>
";
    }

    // line 3
    public function block_widget_header($context, array $blocks = array())
    {
        // line 4
        echo "            <i class=\"icon-file\"></i>
            <h3>Title</h3>
        ";
    }

    // line 9
    public function block_widget_body($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::Widgets/base.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  48 => 9,  42 => 4,  39 => 3,  33 => 10,  31 => 9,  27 => 7,  25 => 3,  73 => 22,  68 => 19,  59 => 17,  55 => 16,  46 => 12,  41 => 9,  38 => 8,  30 => 37,  28 => 3,  26 => 2,  20 => 1,  53 => 6,  50 => 5,  21 => 1,  14 => 2,  44 => 10,  40 => 8,  37 => 7,  32 => 4,  29 => 3,);
    }
}
