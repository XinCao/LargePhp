<?php

namespace DreamHeaven\HuashuoBundle\Tests\Service;

use Doctrine\ODM\MongoDB\DocumentRepository;
use DreamHeaven\HuashuoBundle\Document\SystemPreference;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Snc\RedisBundle\Client\Predis\Client;
use Doctrine\ODM\MongoDB\DocumentManager;

use DreamHeaven\CoreBundle\Service\Service as BaseService;
use DreamHeaven\HuashuoBundle\Service\SystemPreferenceManager;

class SystemPreferenceManagerTest extends \DreamHeaven\CoreBundle\Test\TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $dmMock;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $redisMock;
    /** @var \DreamHeaven\HuashuoBundle\Service\SystemPreferenceManager */
    protected $prefManager;

    public function setUp()
    {
        $this->loggerMock    = $this->getMock('Symfony\Bridge\Monolog\Logger', array('debug', 'notice', 'warn', 'err'), array('test_logger'));
        $testDmClassName = strtr(uniqid('TestDocumentManager_', true), '.', '_');
        $this->dmMock    = $this->getMock('Doctrine\ODM\MongoDB\DocumentManager', array('find', 'persist', 'flush'), array(), $testDmClassName, false);
        $this->redisMock = $this->getMock('Snc\RedisBundle\Client\Predis\Client', array('hget', 'hset'));

        $this->options = array(
            'system_preference_cache_key'       => 'imagetalk:system_preferences:',
            'system_preference_cache_life_time' => 0,
        );

        $this->prefManager = new SystemPreferenceManager($this->dmMock, $this->redisMock, $this->loggerMock, $this->options);

        $this->cacheKey = $this->options['system_preference_cache_key'];
        $this->testPref = new SystemPreference();
        $this->testPref->name = 'system.test_preference_name';
        $this->testPref->data = 'test_pref_data';
        
    }

    public function test_get__with_cache_miss()
    {
        $this->redisMock->expects($this->once())
                        ->method('hget')
                        ->with($this->equalTo($this->cacheKey), $this->equalTo($this->testPref->name))
                        ->will($this->returnValue(null));
        $this->redisMock->expects($this->once())
                        ->method('hset')
                        ->with($this->equalTo($this->cacheKey), $this->equalTo($this->testPref->name), $this->testPref->data);
        if($this->options['system_preference_cache_life_time'])
        {
            $this->redisMock->expects($this->once())
                            ->method('expire')
                            ->with($this->equalTo($this->cacheKey), $this->options['system_preference_cache_life_time']);
        }
        $this->dmMock->expects($this->once())
                     ->method('find')
                     ->with($this->equalTo(SystemPreference::CLASS_NAME), $this->equalTo($this->testPref->name))
                     ->will($this->returnValue($this->testPref));
        $this->loggerMock->expects($this->never())->method('err');
        $this->loggerMock->expects($this->once())->method('debug');

        $value = $this->prefManager->get($this->testPref->name);
        $this->assertEquals($this->testPref->data, $value);
    }

    public function test_get__with_cache_hit()
    {
        $this->redisMock->expects($this->once())
                        ->method('hget')
                        ->with($this->equalTo($this->cacheKey), $this->equalTo($this->testPref->name))
                        ->will($this->returnValue($this->testPref->data));
        $this->redisMock->expects($this->never())->method('hset');
        $this->redisMock->expects($this->never())->method('expire');

        $this->dmMock->expects($this->never())->method('find');
        $this->loggerMock->expects($this->never())->method('err');
        $this->loggerMock->expects($this->never())->method('debug');

        $value = $this->prefManager->get($this->testPref->name);
        $this->assertEquals($this->testPref->data, $value);
    }

    public function test_get__with_non_existance_pref_name()
    {
        $nonExistanceKey = 'non_existance_key';
        $defaultValue = 'test_default_value';
        $this->redisMock->expects($this->once())
                        ->method('hget')
                        ->with($this->equalTo($this->cacheKey), $this->equalTo($nonExistanceKey))
                        ->will($this->returnValue(null));
        $this->redisMock->expects($this->never())->method('hset');
        $this->redisMock->expects($this->never())->method('expire');
        $this->dmMock->expects($this->once())
                     ->method('find')
                     ->with($this->equalTo(SystemPreference::CLASS_NAME), $this->equalTo($nonExistanceKey))
                     ->will($this->returnValue(null));
        $this->loggerMock->expects($this->once())->method('err');
        $this->loggerMock->expects($this->never())->method('debug');

        $value = $this->prefManager->get($nonExistanceKey, $defaultValue);
        $this->assertEquals($defaultValue, $value);
    }

    public function test_set__with_same_value()
    {
        $this->dmMock->expects($this->once())
                     ->method('find')
                     ->with($this->equalTo(SystemPreference::CLASS_NAME), $this->equalTo($this->testPref->name))
                     ->will($this->returnValue($this->testPref));
        $this->dmMock->expects($this->never())->method('persist');
        $this->dmMock->expects($this->never())->method('flush');
        $this->redisMock->expects($this->never())->method('hset');
        $this->loggerMock->expects($this->never())->method('err');
        $this->loggerMock->expects($this->never())->method('debug');

        $this->prefManager->set($this->testPref->name, $this->testPref->data);
    }

    public function test_set__with_existing_pref()
    {
        $testPrefValue = 'new_test_pref_data';
        $this->dmMock->expects($this->once())
                     ->method('find')
                     ->with($this->equalTo(SystemPreference::CLASS_NAME), $this->equalTo($this->testPref->name))
                     ->will($this->returnValue($this->testPref));
        $this->dmMock->expects($this->once())->method('persist');
        $this->dmMock->expects($this->once())->method('flush');

        $this->redisMock->expects($this->once())
                        ->method('hset')
                        ->with($this->equalTo($this->cacheKey), $this->equalTo($this->testPref->name), $testPrefValue);

        if($this->options['system_preference_cache_life_time'])
        {
            $this->redisMock->expects($this->once())
                            ->method('expire')
                            ->with($this->equalTo($this->cacheKey), $this->options['system_preference_cache_life_time']);
        }

        $this->prefManager->set($this->testPref->name, $testPrefValue);
    }

    public function test_set__with_new_pref()
    {
        $testPrefValue = 'new_test_pref_data';
        $this->dmMock->expects($this->once())
                     ->method('find')
                     ->with($this->equalTo(SystemPreference::CLASS_NAME), $this->equalTo($this->testPref->name))
                     ->will($this->returnValue(null));
        $this->dmMock->expects($this->once())->method('persist');
        $this->dmMock->expects($this->once())->method('flush');

        $this->redisMock->expects($this->once())
                        ->method('hset')
                        ->with($this->equalTo($this->cacheKey), $this->equalTo($this->testPref->name), $testPrefValue);

        if($this->options['system_preference_cache_life_time'])
        {
            $this->redisMock->expects($this->once())
                            ->method('expire')
                            ->with($this->equalTo($this->cacheKey), $this->options['system_preference_cache_life_time']);
        }

        $this->prefManager->set($this->testPref->name, $testPrefValue);
    }

}
