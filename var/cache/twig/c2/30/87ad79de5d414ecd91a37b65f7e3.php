<?php

/* DreamHeavenAdminBundle:Shared:menu.html.twig */
class __TwigTemplate_c23087ad79de5d414ecd91a37b65f7e3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'compressed_root' => array($this, 'block_compressed_root'),
            'root' => array($this, 'block_root'),
            'list' => array($this, 'block_list'),
            'children' => array($this, 'block_children'),
            'item' => array($this, 'block_item'),
            'linkElement' => array($this, 'block_linkElement'),
            'spanElement' => array($this, 'block_spanElement'),
            'label' => array($this, 'block_label'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 8
        echo "
";
        // line 9
        $this->displayBlock('compressed_root', $context, $blocks);
        // line 14
        echo "
";
        // line 15
        $this->displayBlock('root', $context, $blocks);
        // line 19
        echo "
";
        // line 20
        $this->displayBlock('list', $context, $blocks);
        // line 27
        echo "
";
        // line 28
        $this->displayBlock('children', $context, $blocks);
        // line 43
        echo "
";
        // line 44
        $this->displayBlock('item', $context, $blocks);
        // line 78
        echo "
";
        // line 79
        $this->displayBlock('linkElement', $context, $blocks);
        // line 80
        echo "
";
        // line 81
        $this->displayBlock('spanElement', $context, $blocks);
        // line 82
        echo "
";
        // line 83
        $this->displayBlock('label', $context, $blocks);
    }

    // line 9
    public function block_compressed_root($context, array $blocks = array())
    {
        // line 10
        ob_start();
        // line 11
        $this->displayBlock("root", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 15
    public function block_root($context, array $blocks = array())
    {
        // line 16
        $context["listAttributes"] = $this->getAttribute($this->getContext($context, "item"), "childrenAttributes");
        // line 17
        $this->displayBlock("list", $context, $blocks);
    }

    // line 20
    public function block_list($context, array $blocks = array())
    {
        // line 21
        if ((($this->getAttribute($this->getContext($context, "item"), "hasChildren") && (!($this->getAttribute($this->getContext($context, "options"), "depth") === 0))) && $this->getAttribute($this->getContext($context, "item"), "displayChildren"))) {
            // line 22
            echo "    <ul";
            echo $this->getAttribute($this, "attributes", array(0 => $this->getContext($context, "listAttributes")), "method");
            echo ">
        ";
            // line 23
            $this->displayBlock("children", $context, $blocks);
            echo "
    </ul>
";
        }
    }

    // line 28
    public function block_children($context, array $blocks = array())
    {
        // line 30
        $context["currentOptions"] = $this->getContext($context, "options");
        // line 31
        $context["currentItem"] = $this->getContext($context, "item");
        // line 33
        if ((!(null === $this->getAttribute($this->getContext($context, "options"), "depth")))) {
            // line 34
            $context["options"] = twig_array_merge($this->getContext($context, "currentOptions"), array("depth" => ($this->getAttribute($this->getContext($context, "currentOptions"), "depth") - 1)));
        }
        // line 36
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "currentItem"), "children"));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 37
            echo "    ";
            $this->displayBlock("item", $context, $blocks);
            echo "
";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 40
        $context["item"] = $this->getContext($context, "currentItem");
        // line 41
        $context["options"] = $this->getContext($context, "currentOptions");
    }

    // line 44
    public function block_item($context, array $blocks = array())
    {
        // line 45
        if ($this->getAttribute($this->getContext($context, "item"), "displayed")) {
            // line 47
            $context["classes"] = (((!twig_test_empty($this->getAttribute($this->getContext($context, "item"), "attribute", array(0 => "class"), "method")))) ? (array(0 => $this->getAttribute($this->getContext($context, "item"), "attribute", array(0 => "class"), "method"))) : (array()));
            // line 48
            if ($this->getAttribute($this->getContext($context, "item"), "current")) {
                // line 49
                $context["classes"] = twig_array_merge($this->getContext($context, "classes"), array(0 => $this->getAttribute($this->getContext($context, "options"), "currentClass")));
                // line 50
                echo "    ";
                // line 51
                echo "        ";
            }
            // line 53
            if ($this->getAttribute($this->getContext($context, "item"), "actsLikeFirst")) {
                // line 54
                $context["classes"] = twig_array_merge($this->getContext($context, "classes"), array(0 => $this->getAttribute($this->getContext($context, "options"), "firstClass")));
            }
            // line 56
            if ($this->getAttribute($this->getContext($context, "item"), "actsLikeLast")) {
                // line 57
                $context["classes"] = twig_array_merge($this->getContext($context, "classes"), array(0 => $this->getAttribute($this->getContext($context, "options"), "lastClass")));
            }
            // line 59
            $context["attributes"] = $this->getAttribute($this->getContext($context, "item"), "attributes");
            // line 60
            if ((!twig_test_empty($this->getContext($context, "classes")))) {
                // line 61
                $context["attributes"] = twig_array_merge($this->getContext($context, "attributes"), array("class" => twig_join_filter($this->getContext($context, "classes"), " ")));
            }
            // line 64
            echo "    <li";
            echo $this->getAttribute($this, "attributes", array(0 => $this->getContext($context, "attributes")), "method");
            echo ">";
            // line 65
            if (((!twig_test_empty($this->getAttribute($this->getContext($context, "item"), "uri"))) && ((!$this->getAttribute($this->getContext($context, "item"), "current")) || $this->getAttribute($this->getContext($context, "options"), "currentAsLink")))) {
                // line 66
                echo "        ";
                $this->displayBlock("linkElement", $context, $blocks);
            } else {
                // line 68
                echo "        ";
                $this->displayBlock("spanElement", $context, $blocks);
            }
            // line 71
            $context["childrenClasses"] = (((!twig_test_empty($this->getAttribute($this->getContext($context, "item"), "childrenAttribute", array(0 => "class"), "method")))) ? (array(0 => $this->getAttribute($this->getContext($context, "item"), "childrenAttribute", array(0 => "class"), "method"))) : (array()));
            // line 72
            $context["childrenClasses"] = twig_array_merge($this->getContext($context, "childrenClasses"), array(0 => ("menu_level_" . $this->getAttribute($this->getContext($context, "item"), "level"))));
            // line 73
            $context["listAttributes"] = twig_array_merge($this->getAttribute($this->getContext($context, "item"), "childrenAttributes"), array("class" => twig_join_filter($this->getContext($context, "childrenClasses"), " ")));
            // line 74
            echo "        ";
            $this->displayBlock("list", $context, $blocks);
            echo "
    </li>
";
        }
    }

    // line 79
    public function block_linkElement($context, array $blocks = array())
    {
        echo "<a href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "item"), "uri"), "html", null, true);
        echo "\"";
        echo $this->getAttribute($this, "attributes", array(0 => $this->getAttribute($this->getContext($context, "item"), "linkAttributes")), "method");
        echo ">";
        $this->displayBlock("label", $context, $blocks);
        echo "</a>";
    }

    // line 81
    public function block_spanElement($context, array $blocks = array())
    {
        echo "<span";
        echo $this->getAttribute($this, "attributes", array(0 => $this->getAttribute($this->getContext($context, "item"), "labelAttributes")), "method");
        echo ">";
        $this->displayBlock("label", $context, $blocks);
        echo "</span>";
    }

    // line 83
    public function block_label($context, array $blocks = array())
    {
        // line 84
        if ((!twig_test_empty($this->getAttribute($this->getContext($context, "item"), "getExtra", array(0 => "icon", 1 => null), "method")))) {
            // line 85
            echo "    <i class=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "item"), "getExtra", array(0 => "icon"), "method"), "html", null, true);
            echo "\"></i>";
        }
        // line 87
        echo "
    ";
        // line 88
        if (($this->getAttribute($this->getContext($context, "options"), "allow_safe_labels") && $this->getAttribute($this->getContext($context, "item"), "getExtra", array(0 => "safe_label", 1 => false), "method"))) {
            // line 89
            echo "    ";
            echo $this->getAttribute($this->getContext($context, "item"), "label");
            echo "
    ";
        } else {
            // line 91
            echo "    ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "item"), "label"), "html", null, true);
            echo "
    ";
        }
        // line 94
        $context["badge"] = $this->getAttribute($this->getContext($context, "item"), "getExtra", array(0 => "badge", 1 => null), "method");
        // line 95
        if ((!twig_test_empty($this->getContext($context, "badge")))) {
            // line 96
            $context["badgeClass"] = (($this->getAttribute($this->getContext($context, "item"), "getExtra", array(0 => "badge_class"), "method")) ? ($this->getAttribute($this->getAttribute(" badge-", "item"), "getExtra", array(0 => "badge_class"), "method")) : (""));
            // line 97
            echo "    <span class=\"badge";
            echo twig_escape_filter($this->env, $this->getContext($context, "badgeClass"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getContext($context, "badge"), "html", null, true);
            echo "</span>";
        }
    }

    // line 1
    public function getattributes($_attributes = null)
    {
        $context = $this->env->mergeGlobals(array(
            "attributes" => $_attributes,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "attributes"));
            foreach ($context['_seq'] as $context["name"] => $context["value"]) {
                // line 3
                if (((!(null === $this->getContext($context, "value"))) && (!($this->getContext($context, "value") === false)))) {
                    // line 4
                    echo sprintf(" %s=\"%s\"", $this->getContext($context, "name"), ((($this->getContext($context, "value") === true)) ? (twig_escape_filter($this->env, $this->getContext($context, "name"))) : (twig_escape_filter($this->env, $this->getContext($context, "value")))));
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['value'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle:Shared:menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  303 => 4,  301 => 3,  297 => 2,  277 => 97,  275 => 96,  271 => 94,  265 => 91,  259 => 89,  257 => 88,  249 => 85,  244 => 83,  234 => 81,  222 => 79,  211 => 73,  209 => 72,  207 => 71,  197 => 65,  193 => 64,  190 => 61,  188 => 60,  186 => 59,  183 => 57,  181 => 56,  178 => 54,  176 => 53,  173 => 51,  171 => 50,  169 => 49,  167 => 48,  165 => 47,  163 => 45,  160 => 44,  156 => 41,  154 => 40,  137 => 37,  120 => 36,  117 => 34,  108 => 28,  93 => 21,  90 => 20,  86 => 17,  84 => 16,  81 => 15,  74 => 11,  69 => 9,  62 => 82,  60 => 81,  42 => 27,  40 => 20,  52 => 78,  43 => 10,  35 => 15,  45 => 28,  31 => 4,  32 => 14,  26 => 2,  20 => 1,  367 => 157,  363 => 156,  358 => 154,  354 => 153,  348 => 150,  344 => 149,  339 => 146,  334 => 143,  328 => 142,  318 => 140,  315 => 139,  312 => 138,  308 => 137,  305 => 136,  299 => 135,  292 => 131,  289 => 130,  286 => 1,  282 => 128,  279 => 127,  276 => 126,  273 => 95,  270 => 124,  262 => 162,  260 => 124,  254 => 87,  251 => 120,  247 => 84,  240 => 107,  233 => 104,  229 => 102,  227 => 101,  216 => 93,  213 => 74,  210 => 91,  206 => 86,  203 => 68,  199 => 66,  196 => 83,  191 => 10,  185 => 87,  182 => 85,  180 => 83,  119 => 31,  111 => 30,  107 => 28,  103 => 27,  99 => 26,  95 => 22,  91 => 24,  87 => 23,  83 => 22,  79 => 21,  71 => 16,  63 => 17,  47 => 43,  37 => 19,  34 => 5,  27 => 8,  25 => 1,  123 => 32,  115 => 33,  113 => 31,  109 => 21,  105 => 20,  100 => 23,  96 => 17,  92 => 16,  88 => 15,  85 => 14,  82 => 13,  75 => 20,  72 => 10,  70 => 13,  65 => 83,  61 => 10,  59 => 16,  57 => 80,  55 => 79,  51 => 1,  28 => 3,  53 => 2,  50 => 44,  21 => 1,  14 => 6,  127 => 33,  124 => 86,  67 => 18,  41 => 8,  38 => 7,  33 => 4,  30 => 9,);
    }
}
