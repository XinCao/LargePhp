<?php

/* DreamHeavenAdminBundle:GameMaster/RealmManagement:edit.html.twig */
class __TwigTemplate_471a591b576d6be4e23d321c386c371e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DreamHeavenAdminBundle::layout-GameMaster.html.twig");

        $_trait_0 = $this->env->loadTemplate("DreamHeavenAdminBundle::Shared/sidebarMenu.html.twig");
        // line 2
        if (!$_trait_0->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."DreamHeavenAdminBundle::Shared/sidebarMenu.html.twig".'" cannot be used as a trait.');
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $_trait_1 = $this->env->loadTemplate("DreamHeavenAdminBundle::GameMaster/menus.html.twig");
        // line 3
        if (!$_trait_1->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."DreamHeavenAdminBundle::GameMaster/menus.html.twig".'" cannot be used as a trait.');
        }
        $_trait_1_blocks = $_trait_1->getBlocks();

        $this->traits = array_merge(
            $_trait_0_blocks,
            $_trait_1_blocks
        );

        $this->blocks = array_merge(
            $this->traits,
            array(
                'title' => array($this, 'block_title'),
                'sidebar' => array($this, 'block_sidebar'),
                'extra_script_block' => array($this, 'block_extra_script_block'),
                'main_content' => array($this, 'block_main_content'),
            )
        );
    }

    protected function doGetParent(array $context)
    {
        return "DreamHeavenAdminBundle::layout-GameMaster.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 4
        $context["sf"] = $this->env->loadTemplate("LianzSimpleFormBundle::helpers.html.twig");
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        // line 7
        echo "服务器管理 | 后台管理
";
    }

    // line 10
    public function block_sidebar($context, array $blocks = array())
    {
        // line 11
        echo "  ";
        $this->displayBlock("sidebar_menu", $context, $blocks);
        echo "
";
    }

    // line 14
    public function block_extra_script_block($context, array $blocks = array())
    {
        // line 15
        echo "<script language=\"javascript\">
    \$(document).ready(function() {
        \$('#btn-new-realm').click(function(e){
            e.preventDefault();
            \$('#realms tr:last').before('<tr><td></td><td><input name=\"new:num[]\" type=\"text\" class=\"input-small\" /></td>' +
                                        '<td><input name=\"new:name[]\" type=\"text\" class=\"span12\" /></td>' +
                                        '<td><select name=\"new:type[]\" class=\"input-small\"><option value=\"0\">普通服</option><option value=\"1\">热门服</option><option value=\"2\">新服</option><option value=\"3\">推荐服</option><option value=\"4\">测试服</option></select></td>' +
                                        '<td><input name=\"new:address[]\" type=\"text\" class=\"input-medium\" /></td>' +
                                        '<td><input name=\"new:mgmt_address[]\" type=\"text\" class=\"input-medium\" /></td></tr>');
        });
    });
</script>
";
    }

    // line 29
    public function block_main_content($context, array $blocks = array())
    {
        // line 30
        echo "<div class=\"row-fluid\">
  <form class=\"form form-horizontal\" method=\"POST\" action=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_game_master_realm_management_edit"), "html", null, true);
        echo "\">
    <fieldset>
      <legend>服务器列表管理</legend>
      <table id=\"realms\" class=\"table table-bordered\">
        <thead>
          <tr>
            <td style=\"width: 30px;\"></td>
            <td style=\"width: 30px;\">服务器序号</td>
            <td style=\"width: 100%;\">名字</td>
            <td style=\"width: 100px;\">类型</td>
            <td style=\"width: 250px;\">服务器地址(客户端连接用)</td>
            <td style=\"width: 250px;\">管理地址(后台用)</td>
          </tr>
        </thead>
        <tbody>
          ";
        // line 46
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["realms"]) ? $context["realms"] : $this->getContext($context, "realms")));
        foreach ($context['_seq'] as $context["_key"] => $context["realm"]) {
            // line 47
            echo "            <tr>
              <td><input name=\"selected_ids[]\" value=\"";
            // line 48
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["realm"]) ? $context["realm"] : $this->getContext($context, "realm")), "id"), "html", null, true);
            echo "\" type=\"checkbox\" /></td>
              <td><input name=\"ids[]\" value=\"";
            // line 49
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["realm"]) ? $context["realm"] : $this->getContext($context, "realm")), "id"), "html", null, true);
            echo "\" type=\"hidden\" />
                <input name=\"";
            // line 50
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["realm"]) ? $context["realm"] : $this->getContext($context, "realm")), "id"), "html", null, true);
            echo ":num\" value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["realm"]) ? $context["realm"] : $this->getContext($context, "realm")), "realm_num"), "html", null, true);
            echo "\" type=\"text\" class=\"input-small\" /></td>
              <td><input name=\"";
            // line 51
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["realm"]) ? $context["realm"] : $this->getContext($context, "realm")), "id"), "html", null, true);
            echo ":name\" value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["realm"]) ? $context["realm"] : $this->getContext($context, "realm")), "name"), "html", null, true);
            echo "\" type=\"text\" class=\"span12\" /></td>
              <td>
                  ";
            // line 53
            $context["types"] = array("0" => "普通服", "1" => "热门服", "2" => "新服", "3" => "推荐服", "4" => "测试服");
            // line 54
            echo "                  <select name=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["realm"]) ? $context["realm"] : $this->getContext($context, "realm")), "id"), "html", null, true);
            echo ":type\" class=\"input-small\">
                      ";
            // line 55
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["types"]) ? $context["types"] : $this->getContext($context, "types")));
            foreach ($context['_seq'] as $context["type"] => $context["type_name"]) {
                // line 56
                echo "                          <option value=\"";
                echo twig_escape_filter($this->env, (isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "html", null, true);
                echo "\"";
                echo ((($this->getAttribute((isset($context["realm"]) ? $context["realm"] : $this->getContext($context, "realm")), "type") == (isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")))) ? (" selected=\"selected\"") : (""));
                echo ">";
                echo twig_escape_filter($this->env, (isset($context["type_name"]) ? $context["type_name"] : $this->getContext($context, "type_name")), "html", null, true);
                echo "</option>
                      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['type'], $context['type_name'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 58
            echo "                  </select>
              </td>
              <td><input name=\"";
            // line 60
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["realm"]) ? $context["realm"] : $this->getContext($context, "realm")), "id"), "html", null, true);
            echo ":address\" value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["realm"]) ? $context["realm"] : $this->getContext($context, "realm")), "address"), "html", null, true);
            echo "\" type=\"text\" class=\"input-medium\" /></td>
              <td><input name=\"";
            // line 61
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["realm"]) ? $context["realm"] : $this->getContext($context, "realm")), "id"), "html", null, true);
            echo ":mgmt_address\" value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["realm"]) ? $context["realm"] : $this->getContext($context, "realm")), "mgmt_address"), "html", null, true);
            echo "\" type=\"text\" class=\"input-medium\" /></td>
            </tr>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['realm'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 64
        echo "          <tr>
            <td colspan=\"5\">
              <button id=\"btn-new-realm\" class=\"btn btn-success\"><i class=\"icon-plus\"></i> 添加服务器</button>
            </td>
          </tr>
        </tbody>
      </table>

      <p>
        <button id=\"btn-save-realms\" class=\"btn btn-primary\" name=\"action\" value=\"save\"><i class=\"icon-ok\"></i> 保存服务器列表</button>&nbsp;
        <button id=\"btn-delete-selected-realms\" class=\"btn btn-danger\" name=\"action\" value=\"delete\"><i class=\"icon-remove\"></i> 删除选中的服务器</button>
      </p>
    </fieldset>
  </form>
</div>
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle:GameMaster/RealmManagement:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  189 => 64,  178 => 61,  172 => 60,  168 => 58,  155 => 56,  151 => 55,  146 => 54,  144 => 53,  137 => 51,  131 => 50,  127 => 49,  123 => 48,  120 => 47,  116 => 46,  98 => 31,  95 => 30,  92 => 29,  76 => 15,  73 => 14,  66 => 11,  63 => 10,  58 => 7,  55 => 6,  50 => 4,  21 => 3,  14 => 2,);
    }
}
