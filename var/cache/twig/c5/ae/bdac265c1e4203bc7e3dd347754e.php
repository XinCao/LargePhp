<?php

/* DreamHeavenAdminBundle:Security/Session:login.html.twig */
class __TwigTemplate_c5aebdac265c1e4203bc7e3dd347754e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'extra_style_block' => array($this, 'block_extra_style_block'),
            'extra_script_block' => array($this, 'block_extra_script_block'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<!--[if lt IE 7 ]><html class=\"ie ie6\" lang=\"en\"> <![endif]-->
<!--[if IE 7 ]><html class=\"ie ie7\" lang=\"en\"> <![endif]-->
<!--[if IE 8 ]><html class=\"ie ie8\" lang=\"en\"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html>
<head>
    <title>
        登陆 - 梦想天堂运营系统
    </title>
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=8\"/>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/>
    <meta name=\"robots\" content=\"index,follow\"/>
    <link rel=\"shortcut icon\" href=\"favicon.png\" type=\"image/png\"/>
    ";
        // line 16
        echo "    ";
        // line 17
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/css/bootstrap.css\"/>
    <script src=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/jquery.min.js\"></script>
    <script src=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/bootstrap.js\"></script>
    <script language=\"javascript\">
        \$(document).ready(function() {
            \$(\".login-form input[name=username]\").focus();
        });
    </script>

    ";
        // line 26
        $this->displayBlock('extra_style_block', $context, $blocks);
        // line 28
        echo "
    ";
        // line 29
        $this->displayBlock('extra_script_block', $context, $blocks);
        // line 31
        echo "</head>
<body>
<header style=\"background-color: #000;color:#fff; width:100%; text-align:center;padding: 20px; border-bottom: solid 1px #eee;position: fixed;bottom: top;left: 0;\">
<h1>系统登陆</h1>
</header>

<div class=\"container-fluid\">
    <div class=\"modal login-form\" style=\"top: 25%\">
        <div class=\"modal-header\" style=\"text-align: center;\">
            <h3>系统登陆</h3>
            <h6 style=\"margin-left: 10px;\"></h6>
        </div>
        <form id=\"login-form\" action=\"";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_session_login_check"), "html", null, true);
        echo "\" method=\"POST\" class=\"login-form\" style=\"padding: 10px; margin-bottom: 0px;\">
        <div class=\"modal-body\">
            ";
        // line 45
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 46
            echo "                <div class=\"alert alert-error\" id=\"error\">
                    ";
            // line 47
            echo twig_escape_filter($this->env, (isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "html", null, true);
            echo "
                </div>
            ";
        } else {
            // line 50
            echo "                <div class=\"alert alert-error hide\" id=\"error\">
                </div>
            ";
        }
        // line 53
        echo "            <div class=\"row-fluid\">
                <div class=\"span3\">
                    
                </div>
                <div class=\"span9\">
                        <div class=\"control-group\">
                            <div class=\"input-prepend\">
                                <span class=\"add-on\">
                                    <i class=\"icon-user icon-blue\"></i> 用户名
                                </span><input name=\"username\" value=\"\" type=\"text\" placeholder=\"请输入用户名...\" tabindex=\"10\">
                            </div>
                        </div>
                        <div class=\"control-group\">
                            <div class=\"input-prepend\">
                                <span class=\"add-on\">
                                    <i class=\"icon-tag icon-blue\"></i> 密&nbsp;&nbsp;&nbsp;码
                                </span><input name=\"password\" value=\"\" type=\"password\" placeholder=\"请输入密码...\" tabindex=\"20\">
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class=\"modal-footer\">
            <button class=\"btn btn-primary\" id=\"btn_submit\" type=\"submit\"><i class=\"icon-ok icon-white\" tabindex=\"30\"></i> 登录</button>
        </div>
        </form>
    </div>
</div>

<footer style=\"width:100%; text-align:center;border-top: solid 1px #eee;padding-top: 10px;margin-top: 20px;position: fixed;bottom: 0;left: 0;\">
    ";
        // line 83
        $context["year"] = twig_date_format_filter($this->env, "now", "Y");
        // line 84
        echo "    <p>&copy; 梦想天堂 2012 - ";
        echo twig_escape_filter($this->env, (isset($context["year"]) ? $context["year"] : $this->getContext($context, "year")), "html", null, true);
        echo "，保留所有权利</p>
</footer>
</body>
</html>
";
    }

    // line 26
    public function block_extra_style_block($context, array $blocks = array())
    {
        // line 27
        echo "    ";
    }

    // line 29
    public function block_extra_script_block($context, array $blocks = array())
    {
        // line 30
        echo "    ";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle:Security/Session:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 30,  151 => 29,  147 => 27,  144 => 26,  134 => 84,  132 => 83,  100 => 53,  95 => 50,  89 => 47,  86 => 46,  84 => 45,  79 => 43,  65 => 31,  63 => 29,  60 => 28,  58 => 26,  48 => 19,  44 => 18,  39 => 17,  37 => 16,  21 => 1,);
    }
}
