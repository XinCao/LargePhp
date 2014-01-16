<?php
namespace Lianz\SimpleFormBundle\Tests;

// <editor-fold defaultstate="collapsed" desc="use namespaces">
// </editor-fold>

//require_once 'PHPUnit/TestCase.php';

//require_once __DIR__.'../Validation/Registry.php';
//require_once __DIR__.'../Validation/Validator.php';
//require_once __DIR__.'../Validation/ValidatorInterface.php';
//
//require_once __DIR__.'../Form.php';

class ValidatorTestCase extends \PHPUnit_Framework_TestCase
{
    protected $container;

    public function setUp()
    {
        if(function_exists('mb_internal_encoding'))
        {
            mb_internal_encoding("UTF-8");
        }

//        $kernel = new TestKernel('test', true);
//        $kernel->loadClassCache();
//        $kernel->boot();
//
//        $this->container = $kernel->getContainer();
    }
}
