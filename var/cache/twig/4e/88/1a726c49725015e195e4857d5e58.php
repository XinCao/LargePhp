<?php

/* DreamHeavenAdminBundle::Widgets/UserInfo/index.html.twig */
class __TwigTemplate_4e881a726c49725015e195e4857d5e58 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DreamHeavenAdminBundle::Widgets/base.html.twig");

        $this->blocks = array(
            'widget_header' => array($this, 'block_widget_header'),
            'widget_body' => array($this, 'block_widget_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "DreamHeavenAdminBundle::Widgets/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_widget_header($context, array $blocks = array())
    {
        // line 4
        echo "<i class=\"icon-file\"></i>
用户信息
";
    }

    // line 8
    public function block_widget_body($context, array $blocks = array())
    {
        // line 9
        echo "<dl class=\"dl-horizontal\" style=\"margin: 0px;\">
    <dt style=\"width: 100px;\">名字：</dt>
    <dd name=\"\" style=\"margin-left: 100px;\">
        <a href=\"/admin/customer_service/users/";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["user_id"]) ? $context["user_id"] : $this->getContext($context, "user_id")), "html", null, true);
        echo "\" target=\"_new\">";
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), "html", null, true);
        echo "</a>
    </dd>
    <dt style=\"width: 100px;\">我的角色：</dt>
    <dd name=\"\" style=\"margin-left: 100px;\">
        ";
        // line 16
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["roles"]) ? $context["roles"] : $this->getContext($context, "roles")));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            // line 17
            echo "        ";
            echo twig_escape_filter($this->env, (isset($context["role"]) ? $context["role"] : $this->getContext($context, "role")), "html", null, true);
            echo "<br/>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 19
        echo "    </dd>
    <dt style=\"width: 100px;\">最后登录：</dt>
    <dd name=\"\" style=\"margin-left: 100px;\">
        ";
        // line 22
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["last_login"]) ? $context["last_login"] : $this->getContext($context, "last_login")), "Y-m-d H:i:s"), "html", null, true);
        echo "
    </dd>
</dl>
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::Widgets/UserInfo/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 22,  68 => 19,  59 => 17,  55 => 16,  46 => 12,  41 => 9,  38 => 8,  30 => 37,  28 => 3,  26 => 2,  20 => 1,  53 => 6,  50 => 5,  21 => 3,  14 => 2,  44 => 10,  40 => 8,  37 => 7,  32 => 4,  29 => 3,);
    }
}
