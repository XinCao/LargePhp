<?php

/* DreamHeavenAdminBundle::Shared/formHelpers.html.twig */
class __TwigTemplate_3a275df3bae90b991ae3848fca8b0dcc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
    }

    // line 1
    public function getrender_field($_field = null, $_label_options = null, $_widget_options = null, $_error_options = null)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $_field,
            "label_options" => $_label_options,
            "widget_options" => $_widget_options,
            "error_options" => $_error_options,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            echo "    ";
            $context["vars"] = $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "vars");
            // line 3
            echo "    ";
            $context["label_options"] = (((isset($context["label_options"]) ? $context["label_options"] : $this->getContext($context, "label_options"))) ? ((isset($context["label_options"]) ? $context["label_options"] : $this->getContext($context, "label_options"))) : (array("attr" => array("class" => "control-label"))));
            // line 4
            echo "    ";
            $context["widget_options"] = (((isset($context["widget_options"]) ? $context["widget_options"] : $this->getContext($context, "widget_options"))) ? ((isset($context["widget_options"]) ? $context["widget_options"] : $this->getContext($context, "widget_options"))) : (array()));
            // line 5
            echo "    ";
            $context["error_options"] = (((isset($context["error_options"]) ? $context["error_options"] : $this->getContext($context, "error_options"))) ? ((isset($context["error_options"]) ? $context["error_options"] : $this->getContext($context, "error_options"))) : (array("attr" => array("class" => "help-inline"))));
            // line 6
            echo "    <div class=\"control-group ";
            echo (($this->getAttribute((isset($context["vars"]) ? $context["vars"] : $this->getContext($context, "vars")), "errors")) ? (" error") : (""));
            echo "\">
        ";
            // line 7
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), 'label', (isset($context["label_options"]) ? $context["label_options"] : $this->getContext($context, "label_options")));
            echo "
         <div class=\"controls docs-input-sizes\">
             ";
            // line 9
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), 'widget', (isset($context["widget_options"]) ? $context["widget_options"] : $this->getContext($context, "widget_options")));
            echo "
             ";
            // line 10
            if ($this->getAttribute((isset($context["vars"]) ? $context["vars"] : $this->getContext($context, "vars")), "errors")) {
                // line 11
                echo "                 ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["vars"]) ? $context["vars"] : $this->getContext($context, "vars")), "errors"));
                foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                    // line 12
                    echo "                 ";
                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), 'label', (isset($context["error_options"]) ? $context["error_options"] : $this->getContext($context, "error_options")) + (twig_test_empty($_label_ = $this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "getMessageTemplate", array(), "method")) ? array() : array("label" => $_label_)));
                    echo "
                 ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 14
                echo "             ";
            }
            // line 15
            echo "         </div>
    </div>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::Shared/formHelpers.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 15,  68 => 12,  63 => 11,  61 => 10,  57 => 9,  47 => 6,  44 => 5,  41 => 4,  38 => 3,  30 => 10,  28 => 3,  26 => 2,  20 => 1,  83 => 19,  81 => 18,  77 => 14,  71 => 14,  65 => 10,  62 => 9,  55 => 6,  52 => 7,  21 => 1,  14 => 2,  125 => 69,  121 => 68,  117 => 67,  113 => 66,  109 => 65,  103 => 64,  94 => 57,  91 => 18,  43 => 10,  40 => 9,  35 => 2,  32 => 5,  27 => 3,);
    }
}
