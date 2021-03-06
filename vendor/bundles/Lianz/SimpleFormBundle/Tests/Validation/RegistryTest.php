<?php
namespace Lianz\SimpleFormBundle\Tests\Validators;

use Lianz\SimpleFormBundle\Validation\Registry;

class RegistryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetRegistry()
    {
        // valid
        $reg1 = Registry::getRegistry();
        $reg2 = Registry::getRegistry('default');
        $this->assertSame($reg1, $reg2);

        $reg1 = Registry::getRegistry('one-registry');
        $reg2 = Registry::getRegistry('another-registry');
        $this->assertNotSame($reg1, $reg2);
    }
}
