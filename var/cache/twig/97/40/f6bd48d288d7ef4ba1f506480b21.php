<?php

/* LianzSimpleFormBundle::helpers.html.twig */
class __TwigTemplate_9740f6bd48d288d7ef4ba1f506480b21 extends Twig_Template
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
        // line 8
        echo "
";
        // line 16
        echo "
";
        // line 22
        echo "
";
        // line 31
        echo "
";
        // line 43
        echo "
";
        // line 48
        echo "
";
        // line 53
        echo "
";
        // line 58
        echo "
";
        // line 74
        echo "
";
        // line 90
        echo "
";
        // line 99
        echo "
";
        // line 115
        echo "
";
        // line 125
        echo "
";
        // line 137
        echo "
";
        // line 145
        echo "
";
        // line 156
        echo "
";
        // line 163
        echo "
";
    }

    // line 1
    public function getattrs($_attrs = array())
    {
        $context = $this->env->mergeGlobals(array(
            "attrs" => $_attrs,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            ob_start();
            // line 3
            echo "  ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
            foreach ($context['_seq'] as $context["attrName"] => $context["attrValue"]) {
                // line 4
                echo "      ";
                echo ((((" " . (isset($context["attrName"]) ? $context["attrName"] : $this->getContext($context, "attrName"))) . "=\"") . (isset($context["attrValue"]) ? $context["attrValue"] : $this->getContext($context, "attrValue"))) . "\"");
                echo "
  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['attrName'], $context['attrValue'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 9
    public function getlabel_begin($_field = null, $_attrs = array())
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $_field,
            "attrs" => $_attrs,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 10
            ob_start();
            // line 11
            echo "    ";
            $context["sf"] = $this;
            // line 12
            echo "    ";
            $context["attrs"] = twig_array_merge(array("for" => $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name"), "class" => "control-label"), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
            // line 13
            echo "      <label ";
            echo $context["sf"]->getattrs((isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
            echo ">
";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 17
    public function getlabel_end()
    {
        $context = $this->env->getGlobals();

        $blocks = array();

        ob_start();
        try {
            // line 18
            ob_start();
            // line 19
            echo "    </label>
";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 23
    public function getlabel($_field = null, $_label_text = null, $_attrs = array(), $_mark_required = " *")
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $_field,
            "label_text" => $_label_text,
            "attrs" => $_attrs,
            "mark_required" => $_mark_required,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 24
            ob_start();
            // line 25
            echo "    ";
            $context["sf"] = $this;
            // line 26
            echo "    ";
            echo $context["sf"]->getlabel_begin((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
            echo "
      ";
            // line 27
            echo twig_escape_filter($this->env, (isset($context["label_text"]) ? $context["label_text"] : $this->getContext($context, "label_text")), "html", null, true);
            echo twig_escape_filter($this->env, ((((isset($context["mark_required"]) ? $context["mark_required"] : $this->getContext($context, "mark_required")) && $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "required"))) ? ((isset($context["mark_required"]) ? $context["mark_required"] : $this->getContext($context, "mark_required"))) : ("")), "html", null, true);
            echo "
    ";
            // line 28
            echo $context["sf"]->getlabel_end();
            echo "
";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 32
    public function getinput($_field = null, $_type = null, $_attrs = array(), $_raw = false)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $_field,
            "type" => $_type,
            "attrs" => $_attrs,
            "raw" => $_raw,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 33
            ob_start();
            // line 34
            echo "  ";
            $context["sf"] = $this;
            // line 35
            echo "  ";
            $context["form"] = $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "form");
            // line 36
            echo "  ";
            $this->getAttribute($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "form"), "setRendered", array(0 => $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name"), 1 => true), "method");
            // line 37
            echo "  ";
            if ((!$this->getAttribute((isset($context["attrs"]) ? $context["attrs"] : null), "id", array(), "any", true, true))) {
                // line 38
                echo "    ";
                $context["attrs"] = twig_array_merge(array("id" => $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name")), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
                // line 39
                echo "  ";
            }
            // line 40
            echo "  <input name=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name"), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, (((isset($context["raw"]) ? $context["raw"] : $this->getContext($context, "raw"))) ? ($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "value")) : ($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "value"))), "html", null, true);
            echo "\" type=\"";
            echo twig_escape_filter($this->env, (isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "html", null, true);
            echo "\" ";
            echo $context["sf"]->getattrs((isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
            echo " />
";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 44
    public function gettext($_field = null, $_attrs = array(), $_raw = false)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $_field,
            "attrs" => $_attrs,
            "raw" => $_raw,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 45
            echo "  ";
            $context["sf"] = $this;
            // line 46
            echo "  ";
            echo $context["sf"]->getinput((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "text", (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")), (isset($context["raw"]) ? $context["raw"] : $this->getContext($context, "raw")));
            echo "
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 49
    public function getpassword($_field = null, $_attrs = array())
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $_field,
            "attrs" => $_attrs,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 50
            echo "  ";
            $context["sf"] = $this;
            // line 51
            echo "  ";
            echo $context["sf"]->getinput((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "password", (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")), true);
            echo "
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 54
    public function gethidden($_field = null, $_attrs = array())
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $_field,
            "attrs" => $_attrs,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 55
            echo "  ";
            $context["sf"] = $this;
            // line 56
            echo "  ";
            echo $context["sf"]->getinput((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "hidden", (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")), false);
            echo "
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 59
    public function getcheckbox($_field = null, $_value = null, $_text = null, $_attrs = array(), $_label_attrs = array())
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $_field,
            "value" => $_value,
            "text" => $_text,
            "attrs" => $_attrs,
            "label_attrs" => $_label_attrs,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 60
            echo "  ";
            $context["sf"] = $this;
            // line 61
            echo "  ";
            if ((!$this->getAttribute((isset($context["attrs"]) ? $context["attrs"] : null), "id", array(), "any", true, true))) {
                // line 62
                echo "    ";
                $context["id"] = (($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name") + "_") + $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "value"));
                // line 63
                echo "    ";
                $context["attrs"] = twig_array_merge(array("id" => (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"))), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
                // line 64
                echo "  ";
            }
            // line 65
            echo "  ";
            if (($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "value") == (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
                // line 66
                echo "    ";
                $context["attrs"] = twig_array_merge(array("checked" => "checked"), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
                // line 67
                echo "  ";
            }
            // line 68
            echo "  ";
            $context["label_attrs"] = twig_array_merge(array("class" => "checkbox", "for" => $this->getAttribute((isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")), "id")), (isset($context["label_attrs"]) ? $context["label_attrs"] : $this->getContext($context, "label_attrs")));
            // line 69
            echo "  <label ";
            echo $context["sf"]->getattrs((isset($context["label_attrs"]) ? $context["label_attrs"] : $this->getContext($context, "label_attrs")));
            echo ">
    ";
            // line 70
            echo $context["sf"]->getinput((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "checkbox", (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
            echo "
    ";
            // line 71
            echo (isset($context["text"]) ? $context["text"] : $this->getContext($context, "text"));
            echo "
  </label>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 75
    public function getradio($_field = null, $_value = null, $_text = null, $_attrs = array(), $_label_attrs = array())
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $_field,
            "value" => $_value,
            "text" => $_text,
            "attrs" => $_attrs,
            "label_attrs" => $_label_attrs,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 76
            echo "  ";
            $context["sf"] = $this;
            // line 77
            echo "  ";
            if ((!$this->getAttribute((isset($context["attrs"]) ? $context["attrs"] : null), "id", array(), "any", true, true))) {
                // line 78
                echo "    ";
                $context["id"] = (($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name") + "_") + $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "value"));
                // line 79
                echo "    ";
                $context["attrs"] = twig_array_merge(array("id" => (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"))), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
                // line 80
                echo "  ";
            }
            // line 81
            echo "  ";
            if (($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "value") == (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
                // line 82
                echo "    ";
                $context["attrs"] = twig_array_merge(array("checked" => "checked"), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
                // line 83
                echo "  ";
            }
            // line 84
            echo "  ";
            $context["label_attrs"] = twig_array_merge(array("class" => "radio", "for" => $this->getAttribute((isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")), "id")), (isset($context["label_attrs"]) ? $context["label_attrs"] : $this->getContext($context, "label_attrs")));
            // line 85
            echo "  <label ";
            echo $context["sf"]->getattrs((isset($context["label_attrs"]) ? $context["label_attrs"] : $this->getContext($context, "label_attrs")));
            echo ">
    ";
            // line 86
            echo $context["sf"]->getinput((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "radio", (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
            echo "
    ";
            // line 87
            echo (isset($context["text"]) ? $context["text"] : $this->getContext($context, "text"));
            echo "
  </label>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 91
    public function gettextarea($_field = null, $_attrs = array(), $_raw = false)
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $_field,
            "attrs" => $_attrs,
            "raw" => $_raw,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 92
            echo "  ";
            $context["sf"] = $this;
            // line 93
            echo "  ";
            $this->getAttribute($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "form"), "setRendered", array(0 => $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name"), 1 => true), "method");
            // line 94
            echo "  ";
            if ((!$this->getAttribute((isset($context["attrs"]) ? $context["attrs"] : null), "id", array(), "any", true, true))) {
                // line 95
                echo "    ";
                $context["attrs"] = twig_array_merge(array("id" => $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name")), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
                // line 96
                echo "  ";
            }
            // line 97
            echo "  <textarea name=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name"), "html", null, true);
            echo "\" ";
            echo $context["sf"]->getattrs((isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
            echo ">";
            echo twig_escape_filter($this->env, (((isset($context["raw"]) ? $context["raw"] : $this->getContext($context, "raw"))) ? ($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "value")) : ($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "value"))), "html", null, true);
            echo "</textarea>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 100
    public function getselect($_field = null, $_options = null, $_translate = false, $_attrs = array())
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $_field,
            "options" => $_options,
            "translate" => $_translate,
            "attrs" => $_attrs,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 101
            echo "  ";
            $context["sf"] = $this;
            // line 102
            echo "  ";
            $this->getAttribute($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "form"), "setRendered", array(0 => $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name"), 1 => true), "method");
            // line 103
            echo "  ";
            if ((!$this->getAttribute((isset($context["attrs"]) ? $context["attrs"] : null), "id", array(), "any", true, true))) {
                // line 104
                echo "    ";
                $context["attrs"] = twig_array_merge(array("id" => $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name")), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
                // line 105
                echo "  ";
            }
            // line 106
            echo "  <select name=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name"), "html", null, true);
            echo "\" ";
            echo $context["sf"]->getattrs((isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
            echo ">
  ";
            // line 107
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")));
            foreach ($context['_seq'] as $context["_key"] => $context["opt"]) {
                // line 108
                echo "    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["opt"]) ? $context["opt"] : $this->getContext($context, "opt")), "value"), "html", null, true);
                echo "\" ";
                echo ((($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "value") == $this->getAttribute((isset($context["opt"]) ? $context["opt"] : $this->getContext($context, "opt")), "value"))) ? ("selected=\"selected\"") : (""));
                echo ">
      ";
                // line 109
                $context["opt_text"] = (((isset($context["translate"]) ? $context["translate"] : $this->getContext($context, "translate"))) ? ($this->env->getExtension('translator')->trans($this->getAttribute((isset($context["opt"]) ? $context["opt"] : $this->getContext($context, "opt")), "text"))) : ($this->getAttribute((isset($context["opt"]) ? $context["opt"] : $this->getContext($context, "opt")), "text")));
                // line 110
                echo "      ";
                echo twig_escape_filter($this->env, (isset($context["opt_text"]) ? $context["opt_text"] : $this->getContext($context, "opt_text")), "html", null, true);
                echo "
    </option>
  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['opt'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 113
            echo "  </select>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 116
    public function getbutton($_field = null, $_attrs = array())
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $_field,
            "attrs" => $_attrs,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 117
            echo "  ";
            $context["sf"] = $this;
            // line 118
            echo "  ";
            $this->getAttribute($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "form"), "setRendered", array(0 => $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name"), 1 => true), "method");
            // line 119
            echo "  ";
            if ((!$this->getAttribute((isset($context["attrs"]) ? $context["attrs"] : null), "id", array(), "any", true, true))) {
                // line 120
                echo "    ";
                $context["attrs"] = twig_array_merge(array("id" => ("btn_" + $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name"))), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
                // line 121
                echo "  ";
            }
            // line 122
            echo "  ";
            $context["attrs"] = twig_array_merge(array("class" => "btn"), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
            // line 123
            echo "  <button name=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name"), "html", null, true);
            echo "\" type=\"button\" ";
            echo $context["sf"]->getattrs((isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
            echo ">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "value"), "html", null, true);
            echo "</button>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 126
    public function getsubmit($_text = null, $_input = true, $_attrs = array())
    {
        $context = $this->env->mergeGlobals(array(
            "text" => $_text,
            "input" => $_input,
            "attrs" => $_attrs,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 127
            echo "  ";
            $context["sf"] = $this;
            // line 128
            echo "  ";
            if ((isset($context["input"]) ? $context["input"] : $this->getContext($context, "input"))) {
                // line 129
                echo "    ";
                $context["attrs"] = twig_array_merge(array("name" => "btn_submit"), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
                // line 130
                echo "  ";
            }
            // line 131
            echo "  ";
            if ((!$this->getAttribute((isset($context["attrs"]) ? $context["attrs"] : null), "id", array(), "any", true, true))) {
                // line 132
                echo "    ";
                $context["attrs"] = twig_array_merge(array("id" => ("btn_submit_" . (isset($context["text"]) ? $context["text"] : $this->getContext($context, "text")))), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
                // line 133
                echo "  ";
            }
            // line 134
            echo "  ";
            $context["attrs"] = twig_array_merge(array("class" => "btn btn-primary"), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
            // line 135
            echo "  <button type=\"submit\" ";
            echo $context["sf"]->getattrs((isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")));
            echo ">";
            echo twig_escape_filter($this->env, (isset($context["text"]) ? $context["text"] : $this->getContext($context, "text")), "html", null, true);
            echo "</button>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 138
    public function getrest($_form = null, $_type = "hidden", $_attrs = array(), $_raw = false)
    {
        $context = $this->env->mergeGlobals(array(
            "form" => $_form,
            "type" => $_type,
            "attrs" => $_attrs,
            "raw" => $_raw,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 139
            echo "  ";
            $context["sf"] = $this;
            // line 140
            echo "  ";
            $context["rest_fields"] = $this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "getUnrenderedFields", array(), "method");
            // line 141
            echo "  ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["rest_fields"]) ? $context["rest_fields"] : $this->getContext($context, "rest_fields")));
            foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                // line 142
                echo "    ";
                echo $context["sf"]->getinput((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), (isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), (isset($context["attrs"]) ? $context["attrs"] : $this->getContext($context, "attrs")), (isset($context["raw"]) ? $context["raw"] : $this->getContext($context, "raw")));
                echo "
  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 146
    public function geterror($_field = null, $_translate = false, $_label_attrs = array())
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $_field,
            "translate" => $_translate,
            "label_attrs" => $_label_attrs,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 147
            echo "  ";
            if ($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "error")) {
                // line 148
                echo "    ";
                $context["sf"] = $this;
                // line 149
                echo "    ";
                $context["label_attrs"] = twig_array_merge(array("for" => $this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "name"), "class" => "help-inline error"), (isset($context["label_attrs"]) ? $context["label_attrs"] : $this->getContext($context, "label_attrs")));
                // line 150
                echo "    <label ";
                echo $context["sf"]->getattrs((isset($context["label_attrs"]) ? $context["label_attrs"] : $this->getContext($context, "label_attrs")));
                echo ">
      ";
                // line 151
                $context["error"] = (((isset($context["translate"]) ? $context["translate"] : $this->getContext($context, "translate"))) ? ($this->env->getExtension('translator')->trans($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "error"))) : ($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "error")));
                // line 152
                echo "      ";
                echo (isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"));
                echo "
    </label>
  ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 157
    public function getrules($_form = null)
    {
        $context = $this->env->mergeGlobals(array(
            "form" => $_form,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 158
            echo "  ";
            $context["rules"] = $this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "generateRules", array(), "method");
            // line 159
            echo "  ";
            if ((isset($context["rules"]) ? $context["rules"] : $this->getContext($context, "rules"))) {
                // line 160
                echo "    ";
                echo twig_jsonencode_filter((isset($context["rules"]) ? $context["rules"] : $this->getContext($context, "rules")));
                echo "
  ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 165
    public function getfield($_field = null, $_type = null, $_label_title = null, $_translate = false, $_label_attrs = array(), $_widget_settings = array(), $_error_attrs = array(), $_controls_attrs = array())
    {
        $context = $this->env->mergeGlobals(array(
            "field" => $_field,
            "type" => $_type,
            "label_title" => $_label_title,
            "translate" => $_translate,
            "label_attrs" => $_label_attrs,
            "widget_settings" => $_widget_settings,
            "error_attrs" => $_error_attrs,
            "controls_attrs" => $_controls_attrs,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 166
            ob_start();
            // line 167
            echo "  ";
            $context["sf"] = $this;
            // line 168
            echo "
  ";
            // line 169
            $context["widget_raw"] = (($this->getAttribute((isset($context["widget_settings"]) ? $context["widget_settings"] : null), "raw", array(), "any", true, true)) ? ($this->getAttribute((isset($context["widget_settings"]) ? $context["widget_settings"] : $this->getContext($context, "widget_settings")), "raw")) : (array()));
            // line 170
            echo "  ";
            $context["widget_attrs"] = (($this->getAttribute((isset($context["widget_settings"]) ? $context["widget_settings"] : null), "attrs", array(), "any", true, true)) ? ($this->getAttribute((isset($context["widget_settings"]) ? $context["widget_settings"] : $this->getContext($context, "widget_settings")), "attrs")) : (array()));
            // line 171
            echo "  ";
            $context["widget_desc"] = (($this->getAttribute((isset($context["widget_settings"]) ? $context["widget_settings"] : null), "desc", array(), "any", true, true)) ? ($this->getAttribute((isset($context["widget_settings"]) ? $context["widget_settings"] : $this->getContext($context, "widget_settings")), "desc")) : (null));
            // line 172
            echo "
  ";
            // line 173
            $context["label_attrs"] = twig_array_merge(array("class" => "control-label"), (isset($context["label_attrs"]) ? $context["label_attrs"] : $this->getContext($context, "label_attrs")));
            // line 174
            echo "  ";
            $context["error_attrs"] = twig_array_merge(array("class" => "help-inline error"), (isset($context["error_attrs"]) ? $context["error_attrs"] : $this->getContext($context, "error_attrs")));
            // line 175
            echo "
  ";
            // line 176
            $context["controls_attrs"] = twig_array_merge(array("class" => "controls"), (isset($context["controls_attrs"]) ? $context["controls_attrs"] : $this->getContext($context, "controls_attrs")));
            // line 177
            echo "
  <div class=\"control-group";
            // line 178
            echo (($this->getAttribute((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), "error")) ? (" error") : (""));
            echo "\">
    ";
            // line 179
            $context["label_title"] = (((isset($context["translate"]) ? $context["translate"] : $this->getContext($context, "translate"))) ? ($this->env->getExtension('translator')->trans((isset($context["label_title"]) ? $context["label_title"] : $this->getContext($context, "label_title")))) : ((isset($context["label_title"]) ? $context["label_title"] : $this->getContext($context, "label_title"))));
            // line 180
            echo "    ";
            echo $context["sf"]->getlabel((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), (isset($context["label_title"]) ? $context["label_title"] : $this->getContext($context, "label_title")), (isset($context["label_attrs"]) ? $context["label_attrs"] : $this->getContext($context, "label_attrs")));
            echo "
    <div ";
            // line 181
            echo $context["sf"]->getattrs((isset($context["controls_attrs"]) ? $context["controls_attrs"] : $this->getContext($context, "controls_attrs")));
            echo ">
      ";
            // line 182
            if (((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")) == "text")) {
                // line 183
                echo "        ";
                echo $context["sf"]->gettext((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), (isset($context["widget_attrs"]) ? $context["widget_attrs"] : $this->getContext($context, "widget_attrs")), (isset($context["widget_raw"]) ? $context["widget_raw"] : $this->getContext($context, "widget_raw")));
                echo "
      ";
            } elseif (((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")) == "password")) {
                // line 185
                echo "        ";
                echo $context["sf"]->getpassword((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), (isset($context["widget_attrs"]) ? $context["widget_attrs"] : $this->getContext($context, "widget_attrs")));
                echo "
      ";
            } elseif (((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")) == "hidden")) {
                // line 187
                echo "        ";
                echo $context["sf"]->gethidden((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), (isset($context["widget_attrs"]) ? $context["widget_attrs"] : $this->getContext($context, "widget_attrs")));
                echo "
      ";
            } elseif ((((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")) == "checkbox") || ((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")) == "radio"))) {
                // line 189
                echo "        ";
                $context["widget_label_attrs"] = (($this->getAttribute((isset($context["widget_settings"]) ? $context["widget_settings"] : null), "label_attrs", array(), "any", true, true)) ? ($this->getAttribute((isset($context["widget_settings"]) ? $context["widget_settings"] : $this->getContext($context, "widget_settings")), "label_attrs")) : (array()));
                // line 190
                echo "        ";
                echo $context["sf"]->getcheckbox((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), $this->getAttribute((isset($context["widget_settings"]) ? $context["widget_settings"] : $this->getContext($context, "widget_settings")), "value"), $this->getAttribute((isset($context["widget_settings"]) ? $context["widget_settings"] : $this->getContext($context, "widget_settings")), "text"), (isset($context["widget_attrs"]) ? $context["widget_attrs"] : $this->getContext($context, "widget_attrs")), (isset($context["widget_label_attrs"]) ? $context["widget_label_attrs"] : $this->getContext($context, "widget_label_attrs")));
                echo "
      ";
            } elseif (((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")) == "textarea")) {
                // line 192
                echo "        ";
                echo $context["sf"]->gettextarea((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), (isset($context["widget_attrs"]) ? $context["widget_attrs"] : $this->getContext($context, "widget_attrs")), (isset($context["widget_raw"]) ? $context["widget_raw"] : $this->getContext($context, "widget_raw")));
                echo "
      ";
            } elseif (((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")) == "select")) {
                // line 194
                echo "        ";
                // line 195
                echo "        ";
                echo $context["sf"]->getselect((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), $this->getAttribute((isset($context["widget_settings"]) ? $context["widget_settings"] : $this->getContext($context, "widget_settings")), "options"), (isset($context["translate"]) ? $context["translate"] : $this->getContext($context, "translate")), (isset($context["widget_attrs"]) ? $context["widget_attrs"] : $this->getContext($context, "widget_attrs")));
                echo "
      ";
            } else {
                // line 197
                echo "        <!-- input type \"";
                echo twig_escape_filter($this->env, (isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "html", null, true);
                echo "\" is not supported by this macro -->
      ";
            }
            // line 199
            echo "      ";
            if ((isset($context["widget_desc"]) ? $context["widget_desc"] : $this->getContext($context, "widget_desc"))) {
                // line 200
                echo "        <span class=\"help-block\">";
                echo twig_escape_filter($this->env, (isset($context["widget_desc"]) ? $context["widget_desc"] : $this->getContext($context, "widget_desc")), "html", null, true);
                echo "</span>
      ";
            }
            // line 202
            echo "      ";
            echo $context["sf"]->geterror((isset($context["field"]) ? $context["field"] : $this->getContext($context, "field")), (isset($context["translate"]) ? $context["translate"] : $this->getContext($context, "translate")), (isset($context["error_attrs"]) ? $context["error_attrs"] : $this->getContext($context, "error_attrs")));
            echo "
     </div>
  </div>
";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "LianzSimpleFormBundle::helpers.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  945 => 202,  939 => 200,  936 => 199,  930 => 197,  924 => 195,  922 => 194,  916 => 192,  910 => 190,  907 => 189,  901 => 187,  895 => 185,  889 => 183,  887 => 182,  883 => 181,  878 => 180,  876 => 179,  872 => 178,  869 => 177,  867 => 176,  864 => 175,  861 => 174,  859 => 173,  856 => 172,  853 => 171,  850 => 170,  848 => 169,  845 => 168,  842 => 167,  840 => 166,  822 => 165,  807 => 160,  804 => 159,  801 => 158,  790 => 157,  774 => 152,  772 => 151,  767 => 150,  764 => 149,  761 => 148,  758 => 147,  745 => 146,  727 => 142,  722 => 141,  719 => 140,  716 => 139,  702 => 138,  686 => 135,  683 => 134,  680 => 133,  677 => 132,  674 => 131,  671 => 130,  668 => 129,  665 => 128,  662 => 127,  649 => 126,  631 => 123,  628 => 122,  625 => 121,  622 => 120,  619 => 119,  616 => 118,  613 => 117,  601 => 116,  589 => 113,  579 => 110,  577 => 109,  570 => 108,  566 => 107,  559 => 106,  556 => 105,  553 => 104,  550 => 103,  547 => 102,  544 => 101,  530 => 100,  512 => 97,  509 => 96,  506 => 95,  503 => 94,  500 => 93,  497 => 92,  484 => 91,  470 => 87,  466 => 86,  461 => 85,  458 => 84,  455 => 83,  452 => 82,  449 => 81,  446 => 80,  443 => 79,  440 => 78,  437 => 77,  434 => 76,  419 => 75,  405 => 71,  401 => 70,  396 => 69,  393 => 68,  390 => 67,  387 => 66,  384 => 65,  381 => 64,  378 => 63,  375 => 62,  372 => 61,  369 => 60,  354 => 59,  340 => 56,  337 => 55,  325 => 54,  311 => 51,  308 => 50,  296 => 49,  282 => 46,  279 => 45,  266 => 44,  245 => 40,  242 => 39,  239 => 38,  236 => 37,  233 => 36,  230 => 35,  227 => 34,  225 => 33,  211 => 32,  197 => 28,  192 => 27,  187 => 26,  184 => 25,  182 => 24,  153 => 18,  129 => 13,  126 => 12,  121 => 10,  109 => 9,  90 => 4,  85 => 3,  83 => 2,  72 => 1,  67 => 163,  64 => 156,  61 => 145,  52 => 115,  49 => 99,  46 => 90,  43 => 74,  40 => 58,  37 => 53,  34 => 48,  31 => 43,  28 => 31,  25 => 22,  22 => 16,  19 => 8,  189 => 64,  178 => 61,  172 => 60,  168 => 23,  155 => 19,  151 => 55,  146 => 54,  144 => 17,  137 => 51,  131 => 50,  127 => 49,  123 => 11,  120 => 47,  116 => 46,  98 => 31,  95 => 30,  92 => 29,  76 => 15,  73 => 14,  66 => 11,  63 => 10,  58 => 137,  55 => 125,  50 => 4,  21 => 3,  14 => 2,);
    }
}
