<?php

/* DreamHeavenAdminBundle::GameMaster/UserManagement/_edit_user_form.html.twig */
class __TwigTemplate_bc092bbb4cf792d4e3d3cad3afab0b72 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'extra_script_block' => array($this, 'block_extra_script_block'),
            'edit_user_form' => array($this, 'block_edit_user_form'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('extra_script_block', $context, $blocks);
        // line 19
        echo "
";
        // line 20
        $this->displayBlock('edit_user_form', $context, $blocks);
    }

    // line 1
    public function block_extra_script_block($context, array $blocks = array())
    {
        // line 2
        echo "  <script language=\"javascript\">
    \$(document).ready(function(){
      options = {
                  rules: {
                    username:     {required: true, pattern: /^[a-z0-9_-]+\$/, minlength: 2, maxlength: 25},
                    display_name: {required: true, minlength: 2, maxlength: 25},
                    password:     {minlength: 2, maxlength: 25},
                    password2:    {minlength: 2, maxlength: 25},
                    \"roles[]\":    \"required\",
                  }
      };

      //options = \$.extend({}, common_validation_options, options);
      \$('#edit_user_form').validate(options);
    });
  </script>
";
    }

    // line 20
    public function block_edit_user_form($context, array $blocks = array())
    {
        // line 21
        echo "
  ";
        // line 22
        $context["is_super_admin"] = (array_key_exists("id", $context) && ((isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")) == 1));
        // line 23
        echo "  <div class=\"control-group\">
    <label class=\"control-label\" for=\"username\">登录用户名</label>
    <div class=\"controls\">
      <input type=\"text\" id=\"username\" name=\"username\" placeholder=\"只接受字母和数字做用户名\" value=\"";
        // line 26
        echo twig_escape_filter($this->env, ((array_key_exists("username", $context)) ? ((isset($context["username"]) ? $context["username"] : $this->getContext($context, "username"))) : ("")), "html", null, true);
        echo "\" />
    </div>
  </div>
  <div class=\"control-group\">
    <label class=\"control-label\" for=\"display_name\">姓名</label>
    <div class=\"controls\">
      <input type=\"text\" id=\"display_name\" name=\"display_name\" placeholder=\"为方便管理，请使用真实姓名\" value=\"";
        // line 32
        echo twig_escape_filter($this->env, ((array_key_exists("display_name", $context)) ? ((isset($context["display_name"]) ? $context["display_name"] : $this->getContext($context, "display_name"))) : ("")), "html", null, true);
        echo "\" />
    </div>
  </div>
  <div class=\"control-group\">
    <label class=\"control-label\" for=\"inputPassword\">密码</label>
    <div class=\"controls\">
      <input type=\"password\" name=\"password\" id=\"inputPassword\" placeholder=\"密码\" value=\"";
        // line 38
        echo twig_escape_filter($this->env, ((array_key_exists("password", $context)) ? ((isset($context["password"]) ? $context["password"] : $this->getContext($context, "password"))) : ("")), "html", null, true);
        echo "\">
    </div>
  </div>
  <div class=\"control-group\">
    <label class=\"control-label\" for=\"inputPassword\">确认密码</label>
    <div class=\"controls\">
      <input type=\"password\" name=\"password2\" id=\"inputPassword\" placeholder=\"密码\" value=\"";
        // line 44
        echo twig_escape_filter($this->env, ((array_key_exists("password2", $context)) ? ((isset($context["password2"]) ? $context["password2"] : $this->getContext($context, "password2"))) : ("")), "html", null, true);
        echo "\">
    </div>
  </div>
  <div class=\"control-group\">
    <div class=\"row-fluid\">
      <div class=\"span6\">
        <label class=\"control-label\" for=\"\">用户组</label>
        <div class=\"controls\">
          ";
        // line 52
        if ((array_key_exists("user_roles", $context) && (!twig_test_empty((isset($context["user_roles"]) ? $context["user_roles"] : $this->getContext($context, "user_roles")))))) {
            // line 53
            echo "            ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["user_roles"]) ? $context["user_roles"] : $this->getContext($context, "user_roles")));
            foreach ($context['_seq'] as $context["role"] => $context["role_display_name"]) {
                // line 54
                echo "              ";
                $context["checked"] = ((isset($context["is_super_admin"]) ? $context["is_super_admin"] : $this->getContext($context, "is_super_admin")) || (array_key_exists("roles", $context) && twig_in_filter((isset($context["role"]) ? $context["role"] : $this->getContext($context, "role")), (isset($context["roles"]) ? $context["roles"] : $this->getContext($context, "roles")))));
                // line 55
                echo "                <label class=\"checkbox\">
                  <input type=\"checkbox\" name=\"roles[]\" value=\"";
                // line 56
                echo twig_escape_filter($this->env, (isset($context["role"]) ? $context["role"] : $this->getContext($context, "role")), "html", null, true);
                echo "\" ";
                echo (((isset($context["checked"]) ? $context["checked"] : $this->getContext($context, "checked"))) ? ("checked=\"checked\"") : (""));
                echo " ";
                echo (((isset($context["is_super_admin"]) ? $context["is_super_admin"] : $this->getContext($context, "is_super_admin"))) ? ("disabled=\"disabled\"") : (""));
                echo " /> ";
                echo twig_escape_filter($this->env, (isset($context["role_display_name"]) ? $context["role_display_name"] : $this->getContext($context, "role_display_name")), "html", null, true);
                echo "
                </label>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['role'], $context['role_display_name'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 59
            echo "          ";
        }
        // line 60
        echo "        </div>
      </div>
      <div class=\"span6\">
        <h4>用户组权限一览表</h4>
        <ul>
          <li>超级管理员：包含以下用户组，能做一切事情</li>
          <li>经理：后台管理、游戏管理、玩家管理、运营报表</li>
          <li>GM：玩家管理</li>
          <li>运营：运营报表</li>
        </ul>
      </div>
    </div>
  </div>
  <div class=\"control-group\">
    <div class=\"controls\">
      <label class=\"checkbox\">
        <input type=\"checkbox\" name=\"enabled\" value=\"1\" ";
        // line 76
        echo ((((isset($context["is_super_admin"]) ? $context["is_super_admin"] : $this->getContext($context, "is_super_admin")) || array_key_exists("enabled", $context))) ? ("checked=\"checked\"") : (""));
        echo "
               ";
        // line 77
        echo (((isset($context["is_super_admin"]) ? $context["is_super_admin"] : $this->getContext($context, "is_super_admin"))) ? ("disabled=\"disabled\"") : (""));
        echo "
              />是否可以登录
      </label>
    </div>
  </div>
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::GameMaster/UserManagement/_edit_user_form.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  157 => 77,  153 => 76,  135 => 60,  132 => 59,  117 => 56,  114 => 55,  111 => 54,  106 => 53,  104 => 52,  93 => 44,  84 => 38,  75 => 32,  66 => 26,  59 => 22,  56 => 21,  53 => 20,  33 => 2,  30 => 1,  26 => 20,  23 => 19,  21 => 1,  67 => 16,  61 => 23,  57 => 11,  55 => 10,  52 => 9,  49 => 8,  44 => 5,  41 => 4,  14 => 2,);
    }
}
