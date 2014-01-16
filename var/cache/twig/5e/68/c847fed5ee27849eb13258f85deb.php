<?php

/* DreamHeavenAdminBundle::Shared/operationLogs.html.twig */
class __TwigTemplate_5e68c847fed5ee27849eb13258f85deb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'operation_history' => array($this, 'block_operation_history'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('operation_history', $context, $blocks);
    }

    public function block_operation_history($context, array $blocks = array())
    {
        // line 2
        echo "  <script language=\"javascript\">
    \$(document).ready(function(){
      \$('.toggle-panel').click(function(){
        var panel = \$(this).data('panel');
        \$(panel).toggle();
      });
    });
  </script>
  <div class=\"row-fluid\">
  ";
        // line 11
        if (twig_test_empty($this->getContext($context, "entries"))) {
            // line 12
            echo "      <h1>暂无记录</h1>
  ";
        } else {
            // line 14
            echo "    <table class=\"table table-condensed\">
      <thead>
      <tr class=\"info\">
        <th width=\"50\">ID</th>
        <th width=\"100\">操作</th>
        <th width=\"100\">操作者</th>
        <th width=\"150\">服务器(点击展开列表)</th>
        <th>操作数据</th>
        <th width=\"250\">操作备注</th>
        <th width=\"200\">操作结果(点击展开详细结果)</th>
        <th width=\"140\">操作时间</th>
      </tr>
      </thead>
      <tbody>
      ";
            // line 28
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "entries"));
            foreach ($context['_seq'] as $context["_key"] => $context["entry"]) {
                // line 29
                echo "        ";
                $context["panel"] = ("panel-" . $this->getAttribute($this->getContext($context, "entry"), "id"));
                // line 30
                echo "        <tr>
          <td>";
                // line 31
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "entry", true), "id", array(), "any", true, true)) ? ($this->getAttribute($this->getContext($context, "entry"), "id")) : ("")), "html", null, true);
                echo "</td>
          <td>";
                // line 32
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "entry", true), "op_name", array(), "any", true, true)) ? ($this->getAttribute($this->getContext($context, "entry"), "op_name")) : ("")), "html", null, true);
                echo "</td>
          <td>";
                // line 33
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getContext($context, "entry", true), "user", array(), "any", false, true), "display_name", array(), "any", true, true)) ? ($this->getAttribute($this->getAttribute($this->getContext($context, "entry"), "user"), "display_name")) : ("<未知用户>")), "html", null, true);
                echo "</td>
          <td>
            <span class=\"label label-info toggle-panel\" data-panel=\".";
                // line 35
                echo twig_escape_filter($this->env, $this->getContext($context, "panel"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute($this->getContext($context, "entry"), "server_names"), 0, 15), "html", null, true);
                echo "...</span>
            <div class=\"";
                // line 36
                echo twig_escape_filter($this->env, $this->getContext($context, "panel"), "html", null, true);
                echo "\" style=\"display:none;background-color: #fff;\">
              <table class=\"table\">
                ";
                // line 38
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "entry"), "servers"));
                foreach ($context['_seq'] as $context["_key"] => $context["info"]) {
                    // line 39
                    echo "                <tr>
                  <td>";
                    // line 40
                    echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "info", true), "full_name", array(), "any", true, true)) ? ($this->getAttribute($this->getContext($context, "info"), "full_name")) : (((("(" . $this->getAttribute($this->getContext($context, "info"), "realm")) . "服) ") . $this->getAttribute($this->getContext($context, "info"), "name")))), "html", null, true);
                    echo "</td>
                </tr>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['info'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 43
                echo "              </table>
            </div>
          </td>
          <td><span class=\"toggle-panel\" data-panel=\".";
                // line 46
                echo twig_escape_filter($this->env, $this->getContext($context, "panel"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (((twig_length_filter($this->env, $this->getAttribute($this->getContext($context, "entry"), "content")) > 25)) ? ((twig_slice($this->env, $this->getAttribute($this->getContext($context, "entry"), "content"), 0, 25) . "...")) : ($this->getAttribute($this->getContext($context, "entry"), "content"))), "html", null, true);
                echo "</span>
            <div class=\"";
                // line 47
                echo twig_escape_filter($this->env, $this->getContext($context, "panel"), "html", null, true);
                echo "\" style=\"display:none;background-color: #fff;\">
              ";
                // line 48
                echo nl2br(twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "entry"), "content"), "html", null, true));
                echo "
            </div>
          </td>
          <td>";
                // line 51
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "entry"), "note"), "html", null, true);
                echo "</td>
          <td>
            <span class=\"label label-";
                // line 53
                echo ((($this->getAttribute($this->getContext($context, "entry"), "op_result") == "success")) ? ("success") : ("important"));
                echo " toggle-panel\" data-panel=\".panel-";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "entry"), "id"), "html", null, true);
                echo "\">";
                echo ((($this->getAttribute($this->getContext($context, "entry"), "op_result") == "success")) ? ("成功") : ("失败"));
                echo "</span>
            <div class=\"";
                // line 54
                echo twig_escape_filter($this->env, $this->getContext($context, "panel"), "html", null, true);
                echo "\" style=\"display:none;background-color: #fff;\">
              <table class=\"table\">
                ";
                // line 56
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "entry"), "result"));
                foreach ($context['_seq'] as $context["_key"] => $context["info"]) {
                    // line 57
                    echo "                ";
                    if ($this->getAttribute($this->getContext($context, "info", true), "succeed", array(), "any", true, true)) {
                        echo "}
                <tr ";
                        // line 58
                        echo (($this->getAttribute($this->getContext($context, "info"), "succeed")) ? ("class=\"success\"") : ("class=\"error\""));
                        echo ">
                  <td>";
                        // line 59
                        echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "info", true), "full_name", array(), "any", true, true)) ? ($this->getAttribute($this->getContext($context, "info"), "full_name")) : (((("(" . $this->getAttribute($this->getContext($context, "info"), "realm")) . "服) ") . $this->getAttribute($this->getContext($context, "info"), "name")))), "html", null, true);
                        echo "</td>
                  <td width=\"30\">";
                        // line 60
                        echo (($this->getAttribute($this->getContext($context, "info"), "succeed")) ? ("成功") : ("失败"));
                        echo "</td>
                </tr>
                ";
                    }
                    // line 63
                    echo "                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['info'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 64
                echo "              </table>
            </div>
          </td>
          <td>";
                // line 67
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "entry"), "created_at"), "Y-m-d H:i:s"), "html", null, true);
                echo "</td>
          <td></td>
        </tr>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entry'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 71
            echo "      </tbody>
    </table>
  ";
        }
        // line 74
        echo "  </div>
  
  ";
        // line 76
        $this->env->loadTemplate("DreamHeavenAdminBundle::Shared/paginator.html.twig")->display($context);
        // line 77
        echo "
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::Shared/operationLogs.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  203 => 77,  201 => 76,  197 => 74,  192 => 71,  182 => 67,  177 => 64,  171 => 63,  165 => 60,  161 => 59,  157 => 58,  152 => 57,  148 => 56,  143 => 54,  135 => 53,  130 => 51,  124 => 48,  120 => 47,  114 => 46,  109 => 43,  100 => 40,  97 => 39,  93 => 38,  88 => 36,  82 => 35,  77 => 33,  73 => 32,  69 => 31,  66 => 30,  63 => 29,  59 => 28,  43 => 14,  37 => 11,  20 => 1,  47 => 11,  45 => 10,  42 => 9,  39 => 12,  34 => 5,  31 => 4,  26 => 2,);
    }
}
