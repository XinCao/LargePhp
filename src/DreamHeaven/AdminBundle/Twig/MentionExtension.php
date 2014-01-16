<?php
namespace DreamHeaven\AdminBundle\Twig;

use Twig_Extension;
use DreamHeaven\HuashuoBundle\Document\Profile;
use Twig_Filter_Method;
use Twig_Function_Method;

class MentionExtension extends Twig_Extension
{
    private $router;
    private $logger;

    public function __construct($router, $logger)
    {
        $this->router = $router;
        $this->logger = $logger;
    }

    public function getFilters()
    {
        $options = array('pre_escape' => 'html', 'is_safe' => array('html'));
        return array('render_mention_profile' => new \Twig_Filter_Method($this, 'renderMentionProfile', $options));
    }

    public function renderMentionProfile($content)
    {
        $url = $this->router->generate('admin_customer_service_index');
        $return = preg_replace('/@([^@]{2,20})\(([0-9]+)\)/u', '<a href="'.$url.'?uid=\\2" target="_blank">@\\1</a>', $content);

        return $return;
    }

    public function getName()
    {
        return 'mention_extension';
    }
}
