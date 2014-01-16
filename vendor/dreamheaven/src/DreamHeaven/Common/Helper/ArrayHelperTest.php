<?php
namespace DreamHeaven\Common\Helper;
include_once 'PHPUnit/Framework/TestCase.php';
include_once __DIR__ . '/ArrayHelper.php';


class ArrayHelperTest extends \PHPUnit_Framework_TestCase
{
    const TEST_ELELMENT_COUNT = 1000000;

    public function setUp()
    {
        $this->arr1 = array();
        $this->arr2 = array();
        for ($i = 0; $i < self::TEST_ELELMENT_COUNT; $i++)
        {
            //$this->arr1[] = $i;
            $this->arr1[] = rand(0, self::TEST_ELELMENT_COUNT);
        }
        for ($i = 0; $i < self::TEST_ELELMENT_COUNT/10; $i++)
        {
            $this->arr2[] = rand(0, self::TEST_ELELMENT_COUNT);
        }
    }

    public function testDiff()
    {
        $begin = microtime(true);
        $native = array_diff(array_unique($this->arr1), $this->arr2);
        $nativeCost = microtime(true) - $begin;
        $begin = microtime(true);
        $helper = ArrayHelper::diff($this->arr1, $this->arr2);
        $helperCost = microtime(true) - $begin;

        $this->assertEquals(count($native), count($helper));

        $flipped = array_flip($native);
        $this->assertEquals(count($native), count($flipped));
        foreach($helper as $value)
        {
            unset($flipped[$value]);
        }
        $this->assertEmpty($flipped);

        \printf("diff:     \tnative=%.4fs, helper=%.4fs\n", $nativeCost, $helperCost);
    }

    public function testMerge()
    {
        $begin = microtime(true);
        $native = array_merge($this->arr1, $this->arr2);
        $nativeCost = microtime(true) - $begin;
        $begin = microtime(true);
        $helper = ArrayHelper::merge($this->arr1, $this->arr2);
        $helperCost = microtime(true) - $begin;

        $this->assertEquals(count($native), count($helper));
        $flipped = array_flip($native);
        foreach($helper as $value)
        {
            unset($flipped[$value]);
        }
        $this->assertEmpty($flipped);
        \printf("merge: \tnative=%.4fs, helper=%.4fs\n", $nativeCost, $helperCost);

        $begin = microtime(true);
        $native = array_unique(array_merge($this->arr1, $this->arr2));
        $nativeCost = microtime(true) - $begin;
        $begin = microtime(true);
        $helper = ArrayHelper::merge($this->arr1, $this->arr2, false, true);
        $helperCost = microtime(true) - $begin;

        $this->assertEquals(count($native), count($helper));
        $flipped = array_flip($native);
        $this->assertEquals(count($native), count($flipped));
        foreach($helper as $value)
        {
            unset($flipped[$value]);
        }
        $this->assertEmpty($flipped);
        \printf("unique merge: \tnative=%.4fs, helper=%.4fs\n", $nativeCost, $helperCost);
    }

    public function testUnique()
    {
        $begin = microtime(true);
        $native = array_unique($this->arr1);
        $nativeCost = microtime(true) - $begin;
        $begin = microtime(true);
        $helper = ArrayHelper::unique($this->arr1);
        $helperCost = microtime(true) - $begin;

        $this->assertEquals(count($native), count($helper));
        $flipped = array_flip($native);
        $this->assertEquals(count($native), count($flipped));
        foreach($helper as $value)
        {
            unset($flipped[$value]);
        }
        $this->assertEmpty($flipped);
        \printf("unique: \tnative=%.4fs, helper=%.4fs\n", $nativeCost, $helperCost);
    }

    public function testIntersect()
    {
        $begin = microtime(true);
        $native = array_unique(array_intersect($this->arr1, $this->arr2));
        $nativeCost = microtime(true) - $begin;
        $begin = microtime(true);
        $helper = ArrayHelper::intersect($this->arr1, $this->arr2);
        $helperCost = microtime(true) - $begin;

        $this->assertEquals(count($native), count($helper));
        $flipped = array_flip($native);
        $this->assertEquals(count($native), count($flipped));
        foreach($helper as $value)
        {
            unset($flipped[$value]);
        }
        $this->assertEmpty($flipped);
        \printf("intersect: \tnative=%.4fs, helper=%.4fs\n", $nativeCost, $helperCost);
    }
}

