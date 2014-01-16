<?php

/* DreamHeavenAdminBundle::Shared/flashMessage.html.twig */
class __TwigTemplate_52cf118d822fc022f633999aa08ee8d9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'flash_message' => array($this, 'block_flash_message'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('flash_message', $context, $blocks);
    }

    public function block_flash_message($context, array $blocks = array())
    {
        // line 2
        if ($this->getAttribute($this->getContext($context, "app"), "session")) {
            // line 3
            echo "    ";
            $context["flashBag"] = $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "getFlashBag", array(), "method");
            // line 4
            echo "    ";
            $context["flashes"] = $this->getAttribute($this->getContext($context, "flashBag"), "all", array(), "method");
            // line 5
            echo "    ";
            if ((twig_length_filter($this->env, $this->getContext($context, "flashes")) > 0)) {
                // line 6
                echo "      <div class=\"row-fluid alert-message\">
          <div class=\"span12\">
          ";
                // line 8
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getContext($context, "flashes"));
                foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
                    // line 9
                    echo "              ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getContext($context, "messages"));
                    foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                        // line 10
                        echo "                <div class=\"alert alert-";
                        echo twig_escape_filter($this->env, $this->getContext($context, "type"), "html", null, true);
                        echo "\">
                    ";
                        // line 11
                        echo twig_escape_filter($this->env, $this->getContext($context, "message"), "html", null, true);
                        echo "
                  <button class=\"close\" data-dismiss=\"alert\">&times;</button>
                </div>
              ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
                    $context = array_merge($_parent, array_intersect_key($context, $_parent));
                    // line 15
                    echo "          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['type'], $context['messages'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 16
                echo "          </div>
      </div>
    ";
            }
        }
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::Shared/flashMessage.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  45 => 9,  31 => 4,  32 => 5,  26 => 2,  20 => 1,  367 => 157,  363 => 156,  358 => 154,  354 => 153,  348 => 150,  344 => 149,  339 => 146,  334 => 143,  328 => 142,  318 => 140,  315 => 139,  312 => 138,  308 => 137,  305 => 136,  299 => 135,  292 => 131,  289 => 130,  286 => 129,  282 => 128,  279 => 127,  276 => 126,  273 => 125,  270 => 124,  262 => 162,  260 => 124,  254 => 121,  251 => 120,  247 => 111,  240 => 107,  233 => 104,  229 => 102,  227 => 101,  216 => 93,  213 => 92,  210 => 91,  206 => 86,  203 => 85,  199 => 84,  196 => 83,  191 => 10,  185 => 87,  182 => 85,  180 => 83,  119 => 31,  111 => 29,  107 => 28,  103 => 27,  99 => 26,  95 => 25,  91 => 24,  87 => 23,  83 => 22,  79 => 21,  71 => 16,  63 => 17,  47 => 10,  37 => 6,  34 => 5,  27 => 90,  25 => 1,  123 => 32,  115 => 30,  113 => 22,  109 => 21,  105 => 20,  100 => 18,  96 => 17,  92 => 16,  88 => 15,  85 => 14,  82 => 13,  75 => 20,  72 => 28,  70 => 13,  65 => 15,  61 => 10,  59 => 16,  57 => 4,  55 => 11,  51 => 1,  28 => 3,  53 => 2,  50 => 10,  21 => 7,  14 => 6,  127 => 33,  124 => 86,  67 => 18,  41 => 8,  38 => 7,  33 => 4,  30 => 4,);
    }
}
