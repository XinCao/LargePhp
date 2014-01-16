<?php

/* DreamHeavenAdminBundle:GameManagement/Overview:index.html.twig */
class __TwigTemplate_8489084109edb39fdc3b489dc06ed950 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DreamHeavenAdminBundle::layout-GameManagement.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'extra_script_block' => array($this, 'block_extra_script_block'),
            'main_content' => array($this, 'block_main_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "DreamHeavenAdminBundle::layout-GameManagement.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        // line 4
        echo "服务器总览 | 游戏管理
";
    }

    // line 7
    public function block_extra_script_block($context, array $blocks = array())
    {
        // line 8
        echo "  <script language=\"javascript\">
      function formatServerInfo(serverInfo)
      {
          var info = '<tr>' +
                         '  <td>' +
                         '    (' + serverInfo.realm + '服) ' + serverInfo.name +
                         '  </td>' +
                         '  <td width=\"150\">' +
                         '    <span class=\"badge badge-' + serverInfo.load_info.load_class + ' hasTooltip\"> ' + serverInfo.concurrent_users + ' </span>' +
                         '  </td>' +
                         '  <td width=\"150\">' +
                         '    <span class=\"badge badge-' + serverInfo.load_info.load_class + ' hasTooltip\"> ' + serverInfo.load_info.load_str + ' </span>' +
                         '  </td>' +
                         '</tr>';

          return info;
      }

      function updateServerInfoTable()
      {
          \$('#server_infos_container').hide();
          \$('#server_infos_loading').show();

          \$.ajax({
              url: '";
        // line 32
        echo $this->env->getExtension('routing')->getPath("admin_game_management_server_info_index", array("include-management-info" => "true"));
        echo "',
              dataType: \"json\",
              success: function(data){
                  \$('#server_infos_loading').hide();

                  if(data.length < 1)
                  {
                      \$('#server_infos_empty').show();
                      \$('#server_infos_container').hide();
                      return;
                  }
                  else
                  {
                      \$('#server_infos_empty').hide();
                      \$('#server_infos_container').show();
                  }

                  var infoHtml = '<table class=\"table\">' +
                                    '<tr>' +
                                    '  <td>' +
                                    '    <strong class=\"row-title\">服务器</strong>' +
                                    '  </td>' +
                                    '  <td width=\"150\">' +
                                    '    在线人数' +
                                    '  </td>' +
                                    '  <td width=\"150\">' +
                                    '    负载' +
                                    '  </td>' +
                                    '</tr>';
                  data.forEach(function(item){
                      infoHtml += formatServerInfo(item);
                  });
                  infoHtml += '</table';

                  \$('#server_infos_container').html(infoHtml);
              },
              error: function(arg){
                  var e=arg;
                  \$('#server_infos_loading').hide();
              }
          });
      }

      \$(document).ready(function(){
          updateServerInfoTable();
          setInterval(updateServerInfoTable, 30 * 1000);

          \$('#btn_refresh').click(function(){
              updateServerInfoTable();
          });
      });
  </script>
";
    }

    // line 86
    public function block_main_content($context, array $blocks = array())
    {
        // line 87
        echo "  <div class=\"span8\" style=\"padding-bottom: 15px;\">
      <div class=\"module-title nav-header\">
          <div class=\"row-fluid\">
              <div class=\"span9\">
                  <h2>服务器总览</h2>
              </div>
              <div class=\"span3\">
                  <h2 class=\"pull-right\"><a id=\"btn_refresh\" class=\"btn btn-success\" href=\"#\">马上刷新</a></h2>
              </div>
          </div>
      </div>
      <div class=\"row-striped\">
          <div id=\"server_infos_loading\" class=\"center hide\" style=\"padding: 20px;\">
              正在刷新服务器信息，请稍候...
          </div>
          <div id=\"server_infos_container\" class=\"hide\">
          </div>
          <div class=\"row-fluid hide\" id=\"server_infos_empty\">
              <div class=\"span12\">
                  <div class=\"alert\">请先在后台添加服务器</div>
              </div>
          </div>
      </div>
  </div>

";
    }

    public function getTemplateName()
    {
        return "DreamHeavenAdminBundle:GameManagement/Overview:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 87,  124 => 86,  67 => 32,  41 => 8,  38 => 7,  33 => 4,  30 => 3,);
    }
}
