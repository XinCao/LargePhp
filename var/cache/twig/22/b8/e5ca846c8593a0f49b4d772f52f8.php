<?php

/* DreamHeavenAdminBundle::Shared/header.html.twig */
class __TwigTemplate_22b8e5ca846c8593a0f49b4d772f52f8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'doc_header' => array($this, 'block_doc_header'),
            'title' => array($this, 'block_title'),
            'extra_style_block' => array($this, 'block_extra_style_block'),
            'extra_script_block' => array($this, 'block_extra_script_block'),
            'header' => array($this, 'block_header'),
            'top_nav_bar' => array($this, 'block_top_nav_bar'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('doc_header', $context, $blocks);
        // line 90
        echo "
";
        // line 91
        $this->displayBlock('header', $context, $blocks);
    }

    // line 1
    public function block_doc_header($context, array $blocks = array())
    {
        // line 2
        echo "<!DOCTYPE html>
<!--[if lt IE 7 ]><html class=\"ie ie6\" lang=\"en\"> <![endif]-->
<!--[if IE 7 ]><html class=\"ie ie7\" lang=\"en\"> <![endif]-->
<!--[if IE 8 ]><html class=\"ie ie8\" lang=\"en\"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class=\"not-ie\" lang=\"en\">
    <html>
        <head>
            <title>";
        // line 10
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=8\"/>
            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/>
            <meta name=\"robots\" content=\"index,follow\"/>
            <link rel=\"shortcut icon\" href=\"favicon.png\" type=\"image/png\"/>
            <link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/css/bootstrap.css\"/>
            <link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/css/widget.css\"/>
            <link rel=\"stylesheet\" href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/css/validate.css\"/>
            <link rel=\"stylesheet\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/css/jquery.jcrop.css\"/>
            <link rel=\"stylesheet\" href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/css/jquery-ui.css\"/>
            <link rel=\"stylesheet\" href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/css/smoothness/jquery-ui-1.8.21.custom.css\"/>
            <script src=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/jquery.js\"></script>
            <script src=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/jquery.validate.js\"></script>
            <script src=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/jquery-ui-1.8.21.custom.min.js\"></script>
            <script src=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/jquery.ui.datepicker-zh-CN.js\"></script>
            <script src=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/jquery-ui-slide.min.js\"></script>
            <script src=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/jquery-ui-timepicker-addon.js\"></script>
            <script src=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/additional-methods.js\"></script>
            <script src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/jquery.form.js\"></script>
            <script src=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/bootstrap.js\"></script>
            <script src=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/jquery.flot.js\"></script>
            <script src=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/jquery.flot.pie.js\"></script>
            <script src=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/jquery.exts.js\"></script>
            <script src=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/bundles/dreamheavenadmin/js/jquery.validate.messages.zh-cn.js\"></script>
            <style type=\"text/css\">
                    body {
                        padding-top: 60px;
                        padding-bottom: 40px;
                    }

                    .sidebar-nav {
                        padding: 9px 0;
                    }

                    #main_content_span {
                        margin-left: 15px;
                        padding-left: 14px;
                        border-left: 1px solid #eee;
                    }
            </style>

            <script language=\"javascript\">
                  common_validation_options = {
                      errorClass: 'error help-inline',
                      errorPlacement: function(error, element) {
                         if (element.attr(\"name\") == \"all_servers\")
                           \$(\"#servers_widget_container\").append(error);
                         else if (element.attr(\"name\") == \"chk_kick_all\")
                           error.insertAfter(\"#user_info_checker_container\");
                         else
                           error.insertAfter(element);
                       },
                      highlight: function(element, errorClass, validClass) {
                        \$(element).closest('.control-group').removeClass('success').addClass('error');
                      },
                      success: function(label) {
                        \$(label).closest('.control-group').removeClass('error').addClass('success');
                        \$(label).remove();
                      }
                  };

                  \$(document).ready(function() {
                      \$(\".alert-message\").alert();
                      \$(\".alert-message\").hide().delay(10).slideDown().delay(5000).slideUp();

                      \$('.confirm_required').click(function(e){
                        if(!confirm('确定要执行操作吗？')) {
                          e.preventDefault();
                          return;
                        }
                      });
                  });
            </script>
            ";
        // line 83
        $this->displayBlock('extra_style_block', $context, $blocks);
        // line 85
        echo "            ";
        $this->displayBlock('extra_script_block', $context, $blocks);
        // line 87
        echo "        </head>
        <body>
";
    }

    // line 10
    public function block_title($context, array $blocks = array())
    {
    }

    // line 83
    public function block_extra_style_block($context, array $blocks = array())
    {
        // line 84
        echo "            ";
    }

    // line 85
    public function block_extra_script_block($context, array $blocks = array())
    {
        // line 86
        echo "            ";
    }

    // line 91
    public function block_header($context, array $blocks = array())
    {
        // line 92
        echo "        <section id=\"header\">
            <div class=\"navbar navbar-fixed-top navbar-inverse\" ";
        // line 93
        echo (($this->getContext($context, "is_dev")) ? ("style=\"border-top: 1px solid red;\"") : (""));
        echo ">
                <div class=\"navbar-inner\">
                    <div class=\"container-fluid\">
                        <a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\">
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                        </a>
                        ";
        // line 101
        if ($this->getContext($context, "is_dev")) {
            // line 102
            echo "                        <a class=\"brand\" style=\"color: red;\" href=\"javascript:alert('当前环境为开发环境，请注意不要在生产机上启用开发环境');\">DEV</a>
                        ";
        }
        // line 104
        echo "                        <a class=\"brand\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_game_master_overview_index"), "html", null, true);
        echo "\">梦想天堂运营系统</a>
                        <div class=\"btn-group pull-right\">
                            <a class=\"btn dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                                <i class=\"icon-user\"></i> ";
        // line 107
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "current_user"), "display_name"), "html", null, true);
        echo "
                                <span class=\"caret\"></span>
                            </a>
                            <ul class=\"dropdown-menu\">
                                <li><a href=\"";
        // line 111
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_settings_account_edit"), "html", null, true);
        echo "\">我的账号</a></li>
                                ";
        // line 120
        echo "                                <li class=\"divider\"></li>
                                <li><a href=\"";
        // line 121
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_session_logout"), "html", null, true);
        echo "\">注销</a></li>
                            </ul>
                        </div>
                        ";
        // line 124
        $this->displayBlock('top_nav_bar', $context, $blocks);
        // line 162
        echo "                    </div>
                </div>
            </div>
        </section>
";
    }

    // line 124
    public function block_top_nav_bar($context, array $blocks = array())
    {
        // line 125
        echo "                        ";
        if ($this->getContext($context, "platforms")) {
            // line 126
            echo "                        ";
            $context["cur_platform"] = (($this->getAttribute($this->getAttribute($this->getContext($context, "app", true), "request", array(), "any", false, true), "get", array(0 => "platform"), "method", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getContext($context, "app", true), "request", array(), "any", false, true), "get", array(0 => "platform"), "method"), $this->getContext($context, "default_platform"))) : ($this->getContext($context, "default_platform")));
            // line 127
            echo "                        <div class=\"btn-group btn-mini pull-left\" style=\"margin-right: 0px;\">
                            ";
            // line 128
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "platforms"));
            foreach ($context['_seq'] as $context["pid"] => $context["pinfo"]) {
                // line 129
                echo "                            ";
                if (($this->getContext($context, "pid") == $this->getContext($context, "cur_platform"))) {
                    // line 130
                    echo "                            <a class=\"btn dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                                ";
                    // line 131
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "pinfo"), "name"), "html", null, true);
                    echo "平台
                                <span class=\"caret\"></span>
                            </a>
                            ";
                }
                // line 135
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['pid'], $context['pinfo'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 136
            echo "                            <ul class=\"dropdown-menu\">
                            ";
            // line 137
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "platforms"));
            foreach ($context['_seq'] as $context["pid"] => $context["pinfo"]) {
                // line 138
                echo "                            ";
                $context["route_params"] = twig_array_merge($this->getContext($context, "current_route_params"), array("platform" => $this->getContext($context, "pid")));
                // line 139
                echo "                            ";
                if ((($this->getContext($context, "pid") != "dev") || (($this->getContext($context, "pid") == "dev") && $this->getContext($context, "is_dev")))) {
                    // line 140
                    echo "                                <li";
                    echo ((($this->getContext($context, "pid") == $this->getContext($context, "cur_platform"))) ? (" class=\"disabled\"") : (""));
                    echo "><a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath($this->getContext($context, "current_route"), $this->getContext($context, "route_params")), "html", null, true);
                    echo "\">切换到";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "pinfo"), "name"), "html", null, true);
                    echo "平台</a></li>
                            ";
                }
                // line 142
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['pid'], $context['pinfo'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 143
            echo "                            </ul>
                        </div>
                        ";
        }
        // line 146
        echo "                        <div class=\"nav-collapse\">
                            <ul class=\"nav\">
                                <!--
                                <li class=\"";
        // line 149
        echo ((($this->getContext($context, "current_route") == "admin_dashboard")) ? ("active") : (""));
        echo "\">
                                  <a href=\"";
        // line 150
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_dashboard"), "html", null, true);
        echo "\">首页</a>
                                </li>
                                -->
                                <li class=\"";
        // line 153
        echo (((twig_slice($this->env, $this->getContext($context, "current_route"), 0, twig_length_filter($this->env, "admin_game_master")) == "admin_game_master")) ? ("active") : (""));
        echo "\">
                                    <a href=\"";
        // line 154
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_game_master_overview_index"), "html", null, true);
        echo "\">后台管理</a>
                                </li>
                                <li class=\"";
        // line 156
        echo (((twig_slice($this->env, $this->getContext($context, "current_route"), 0, twig_length_filter($this->env, "admin_game_management")) == "admin_game_management")) ? ("active") : (""));
        echo "\">
                                    <a href=\"";
        // line 157
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_game_management_overview_index"), "html", null, true);
        echo "\">游戏管理</a>
                                </li>
                            </ul>
                        </div>
                    ";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle::Shared/header.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  367 => 157,  363 => 156,  358 => 154,  354 => 153,  348 => 150,  344 => 149,  339 => 146,  334 => 143,  328 => 142,  318 => 140,  315 => 139,  312 => 138,  308 => 137,  305 => 136,  299 => 135,  292 => 131,  289 => 130,  286 => 129,  282 => 128,  279 => 127,  276 => 126,  273 => 125,  270 => 124,  262 => 162,  260 => 124,  254 => 121,  251 => 120,  247 => 111,  240 => 107,  233 => 104,  229 => 102,  227 => 101,  216 => 93,  213 => 92,  210 => 91,  206 => 86,  203 => 85,  199 => 84,  196 => 83,  191 => 10,  185 => 87,  182 => 85,  180 => 83,  119 => 31,  111 => 29,  107 => 28,  103 => 27,  99 => 26,  95 => 25,  91 => 24,  87 => 23,  83 => 22,  79 => 21,  71 => 19,  63 => 17,  47 => 10,  37 => 2,  34 => 1,  27 => 90,  25 => 1,  123 => 32,  115 => 30,  113 => 22,  109 => 21,  105 => 20,  100 => 18,  96 => 17,  92 => 16,  88 => 15,  85 => 14,  82 => 13,  75 => 20,  72 => 28,  70 => 13,  65 => 11,  61 => 10,  59 => 16,  57 => 4,  55 => 15,  51 => 1,  28 => 8,  53 => 2,  50 => 5,  21 => 7,  14 => 6,  127 => 33,  124 => 86,  67 => 18,  41 => 8,  38 => 7,  33 => 4,  30 => 91,);
    }
}
