<?php
namespace Lianz\SimpleFormBundle\TwigExtension;

use Twig_Extension;
use Twig_Filter_Method;
use Twig_Function_Method;

use Lianz\SimpleFormBundle\Form;

class FormExtension extends Twig_Extension
{
    public function __construct()
    {
    }

    public function getFunctions()
    {
        $options = array('pre_escape' => 'html', 'is_safe' => array('html'));
        return array(
        );
    }

    public function getName()
    {
        return 'form_extension';
    }
}
