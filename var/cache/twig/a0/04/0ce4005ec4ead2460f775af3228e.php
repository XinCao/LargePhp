<?php

/* DreamHeavenAdminBundle::Shared/footer.html.twig */
class __TwigTemplate_a0040ce4005ec4ead2460f775af3228e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('footer', $context, $blocks);
    }

    public function block_footer($context, array $blocks = array())
    {
        // line 2
        echo "<footer style=\"text-align:center;border-top: solid 1px #eee;padding-top: 10px;margin-top: 20px;\">
    <div class=\"container-fluid\">
        ";
        // line 4
        $context["year"] = twig_date_format_filter($this->env, "now", "Y");
        // line 5
        echo "        <p>&copy; 梦想天堂 2012 - ";
        echo twig_escape_filter($this->env, $this->getContext($context, "year"), "html", null, true);
        echo "，保留所有权利</p>
    </div>
</footer>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::Shared/footer.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  32 => 5,  26 => 2,  20 => 1,  367 => 157,  363 => 156,  358 => 154,  354 => 153,  348 => 150,  344 => 149,  339 => 146,  334 => 143,  328 => 142,  318 => 140,  315 => 139,  312 => 138,  308 => 137,  305 => 136,  299 => 135,  292 => 131,  289 => 130,  286 => 129,  282 => 128,  279 => 127,  276 => 126,  273 => 125,  270 => 124,  262 => 162,  260 => 124,  254 => 121,  251 => 120,  247 => 111,  240 => 107,  233 => 104,  229 => 102,  227 => 101,  216 => 93,  213 => 92,  210 => 91,  206 => 86,  203 => 85,  199 => 84,  196 => 83,  191 => 10,  185 => 87,  182 => 85,  180 => 83,  119 => 31,  111 => 29,  107 => 28,  103 => 27,  99 => 26,  95 => 25,  91 => 24,  87 => 23,  83 => 22,  79 => 21,  71 => 19,  63 => 17,  47 => 10,  37 => 2,  34 => 1,  27 => 90,  25 => 1,  123 => 32,  115 => 30,  113 => 22,  109 => 21,  105 => 20,  100 => 18,  96 => 17,  92 => 16,  88 => 15,  85 => 14,  82 => 13,  75 => 20,  72 => 28,  70 => 13,  65 => 11,  61 => 10,  59 => 16,  57 => 4,  55 => 15,  51 => 1,  28 => 8,  53 => 2,  50 => 5,  21 => 7,  14 => 6,  127 => 33,  124 => 86,  67 => 18,  41 => 8,  38 => 7,  33 => 4,  30 => 4,);
    }
}
