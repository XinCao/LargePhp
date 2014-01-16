<?php
namespace Lianz\SimpleFormBundle\Validation;

// <editor-fold defaultstate="collapsed" desc="use namespaces">
use Symfony\Component\HttpFoundation\ParameterBag;
// </editor-fold>

class Registry extends ParameterBag
{
    private static $instances = array();
    public function __construct()
    {
        parent::__construct(array());
    }

    /**
     *
     * @param type $name
     * @return Registry
     */
    public static function getRegistry($name = 'default')
    {
        if(!isset(self::$instances[$name]))
        {
            self::$instances[$name] = new self();
        }

        return self::$instances[$name];
    }
}
