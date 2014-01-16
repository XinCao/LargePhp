<?php
namespace DreamHeaven\AdminBundle\Twig;

use Twig_Extension;
use DreamHeaven\HuashuoBundle\Document\Profile;
use Twig_Filter_Method;
use Twig_Function_Method;

use Symfony\Component\Security\Core\Role\SwitchUserRole;

class WidgetExtension extends Twig_Extension
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        $options = array('pre_escape' => 'html', 'is_safe' => array('html'));
        return array('widget' => new \Twig_Function_Method($this, 'renderWidget', $options));
    }

    public function renderWidget($widget, $options = array())
    {
        $class = "DreamHeaven\\AdminBundle\\Widget\\{$widget}Widget";
        $widget = new $class();
        $widget->setContainer($this->container);
        $widget->init($options);
        $result = $widget->render();

        return $result;
    }

    public function getName()
    {
        return 'widget_extension';
    }
}
