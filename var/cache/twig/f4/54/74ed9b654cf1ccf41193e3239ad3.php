<?php

/* DreamHeavenAdminBundle:GameMaster/UserManagement:index.html.twig */
class __TwigTemplate_f45474ed9b654cf1ccf41193e3239ad3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DreamHeavenAdminBundle::layout-GameMaster.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'main_content' => array($this, 'block_main_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "DreamHeavenAdminBundle::layout-GameMaster.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        // line 4
        echo "帐号管理 | 后台管理
";
    }

    // line 7
    public function block_main_content($context, array $blocks = array())
    {
        // line 8
        echo "
  ";
        // line 9
        $this->env->loadTemplate("DreamHeavenAdminBundle::GameMaster/UserManagement/tabs.html.twig")->display($context);
        // line 10
        echo "
  <div class=\"row-fluid\">
    <table class=\"table\">
      <tr>
        <td>ID</td>
        <td>登录帐号</td>
        <td>名字</td>
        <td>用户组</td>
        <td>是否有效</td>
        <td>最后登录时间</td>
        <td>操作</td>
      </tr>
      ";
        // line 22
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "users"));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 23
            echo "        <tr>
          <td>";
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "user"), "id"), "html", null, true);
            echo "</td>
          <td><a href=\"";
            // line 25
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_game_master_user_management_edit", array("id" => $this->getAttribute($this->getContext($context, "user"), "id"))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "user"), "username"), "html", null, true);
            echo "</a></td>
          <td>";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "user"), "display_name"), "html", null, true);
            echo "</td>
          <td>";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "user"), "roles"), "html", null, true);
            echo "</td>
          <td>";
            // line 28
            echo (($this->getAttribute($this->getContext($context, "user"), "enabled")) ? ("是") : ("否"));
            echo "</td>
          <td>";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "user"), "last_login"), "html", null, true);
            echo "</td>
          <td><a href=\"";
            // line 30
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_game_master_user_management_edit", array("id" => $this->getAttribute($this->getContext($context, "user"), "id"))), "html", null, true);
            echo "\">编辑</a></td>
        </tr>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 33
        echo "    </table>
  </div>
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle:GameMaster/UserManagement:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  101 => 33,  92 => 30,  88 => 29,  84 => 28,  80 => 27,  76 => 26,  70 => 25,  66 => 24,  63 => 23,  59 => 22,  45 => 10,  43 => 9,  40 => 8,  37 => 7,  32 => 4,  29 => 3,);
    }
}
