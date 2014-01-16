<?php

/* DreamHeavenAdminBundle:GameMaster/UserManagement:new.html.twig */
class __TwigTemplate_23df61d420a3e8f4bf51b7b736f2724d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DreamHeavenAdminBundle::layout-GameMaster.html.twig");

        $_trait_0 = $this->env->loadTemplate("DreamHeavenAdminBundle::GameMaster/UserManagement/_edit_user_form.html.twig");
        // line 2
        if (!$_trait_0->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."DreamHeavenAdminBundle::GameMaster/UserManagement/_edit_user_form.html.twig".'" cannot be used as a trait.');
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $this->traits = $_trait_0_blocks;

        $this->blocks = array_merge(
            $this->traits,
            array(
                'title' => array($this, 'block_title'),
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        // line 5
        echo "创建用户 | 后台管理
";
    }

    // line 8
    public function block_main_content($context, array $blocks = array())
    {
        // line 9
        echo "
  ";
        // line 10
        $this->env->loadTemplate("DreamHeavenAdminBundle::GameMaster/UserManagement/tabs.html.twig")->display($context);
        // line 11
        echo "
  <div class=\"row-fluid\">
    <form class=\"form-horizontal\" id=\"edit_user_form\" method=\"POST\" action=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_game_master_user_management_create"), "html", null, true);
        echo "\">
    <fieldset>

    ";
        // line 16
        $this->displayBlock("edit_user_form", $context, $blocks);
        echo "

    <div class=\"control-group\">
      <div class=\"controls\">
        <button type=\"submit\" class=\"btn btn-primary\">创建用户</button>
      </div>
    </div>
    </fieldset>
  </form>
  </div>
";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle:GameMaster/UserManagement:new.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 16,  61 => 13,  57 => 11,  55 => 10,  52 => 9,  49 => 8,  44 => 5,  41 => 4,  14 => 2,);
    }
}
