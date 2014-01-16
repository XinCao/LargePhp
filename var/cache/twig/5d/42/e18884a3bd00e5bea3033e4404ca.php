<?php

/* DreamHeavenAdminBundle:Settings:editAccount.html.twig */
class __TwigTemplate_5d42e18884a3bd00e5bea3033e4404ca extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DreamHeavenAdminBundle::Settings/layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'validation_scripts' => array($this, 'block_validation_scripts'),
            'main_content' => array($this, 'block_main_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "DreamHeavenAdminBundle::Settings/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["forms"] = $this->env->loadTemplate("DreamHeavenAdminBundle::Shared/formHelpers.html.twig");
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        // line 6
        echo "编辑账户信息 | 画说客服系统
";
    }

    // line 9
    public function block_validation_scripts($context, array $blocks = array())
    {
        // line 10
        echo "<script>
\$(document).ready(function() {
    \$(\"#edit_account_form\").validate({
        rules:{
            \"editaccount[display_name]\":{
                required:  true
            },
            \"editaccount[old_password]\":{
                minlength: 5
            },
            \"editaccount[new_password][first]\":{
                minlength: 5
            },
            \"editaccount[new_password][second]\":{
                equalTo: \"#editaccount_new_password_first\",
                minlength: 5
            }
        },
        messages:{
            \"editaccount[old_password]\":{
                minlength:  jQuery.format(\"密码不能少于 {0} 个字符\")
            },
            \"editaccount[new_password][first]\":{
                minlength:  jQuery.format(\"新密码不能少于 {0} 个字符\")
            },
            \"editaccount[new_password][second]\":{
                equalTo:    \"两次输入的密码不相同\",
                minlength:  jQuery.format(\"新密码不能少于 {0} 个字符\")
            }
        },

        errorClass: 'help-inline',

        highlight:  function (label) {
            \$(label).closest('.control-group').removeClass('success').addClass('error');
        },

        success:    function (label) {
            label.text('OK!').addClass('help-inline valid')
                 .closest('.control-group').removeClass('error').addClass('success');
        }
    })
});
</script>
";
    }

    // line 56
    public function block_main_content($context, array $blocks = array())
    {
        // line 57
        echo "<div class=\"row\">
    <div class=\"span7\">
        <div class=\"widget\">
            <div class=\"widget-header\">
                <i class=\"icon-user\"></i> 编辑账户
            </div> <!-- /widget-header -->
            <div class=\"widget-content\">
                <form id=\"edit_account_form\" class=\"settings\" action=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_settings_account_update"), "html", null, true);
        echo "\" method=\"POST\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo ">
                    ";
        // line 65
        echo $context["forms"]->getrender_field($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "display_name"), null, array("attr" => array("class" => "span5", "value" => $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "display_name"))));
        echo "
                    ";
        // line 66
        echo $context["forms"]->getrender_field($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "old_password"), null, array("attr" => array("class" => "span5")));
        echo "
                    ";
        // line 67
        echo $context["forms"]->getrender_field($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "new_password"), "first"), array("label" => "新密码"), array("attr" => array("class" => "span5")));
        echo "
                    ";
        // line 68
        echo $context["forms"]->getrender_field($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "new_password"), "second"), array("label" => "再次输入新密码"), array("attr" => array("class" => "span5")));
        echo "
                    ";
        // line 69
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "_token"), 'widget');
        echo "
                    <div class=\"control-group\">
                        <div class=\"controls\">
                        <input class=\"btn btn-primary\" type=\"submit\" value=\"保存\" />
                        </div>
                    </div>
                </form>
            </div> <!-- /widget-content -->
        </div>
    </div>
    <!--/span-->
</div>
<!--/row-->
<!--/span-->
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle:Settings:editAccount.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 69,  121 => 68,  117 => 67,  113 => 66,  109 => 65,  103 => 64,  94 => 57,  91 => 56,  43 => 10,  40 => 9,  35 => 6,  32 => 5,  27 => 3,);
    }
}
