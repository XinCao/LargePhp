<?php
namespace DreamHeaven\AdminBundle\Widget;

use Symfony\Component\DependencyInjection\ContainerAware;

class HelloWidget extends BaseWidget
{
    public function init($options = array())
    {

    }

    public function render()
    {
        return $this->renderView('DreamHeavenAdminBundle::Widgets/Hello/index.html.twig');
    }
}
