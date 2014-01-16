<?php

namespace DreamHeaven\CoreBundle\Service;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

use DreamHeaven\CoreBundle\Document\SystemPreference;
use DreamHeaven\CoreBundle\Service\Service as BaseService;
use Predis\Client;

class SystemPreferenceManager extends BaseService
{
    protected $cachedPreferences = array();

    /** @var DocumentManager */
    protected $dm;

    /** @var Client */
    protected $redis;

    /** @var \Symfony\Bridge\Monolog\Logger */
    protected $logger;

    protected $options;

    public function __construct(DocumentManager $dm, Client $redis, LoggerInterface $logger = null, $options = array())
    {
        $this->dm      = $dm;
        $this->redis   = $redis;
        $this->logger  = $logger;

        $this->options = array_merge(
            array(
                'system_preference_cache_key'       => 'imagetalk:system_preferences:',
                'system_preference_cache_life_time' => 0,
            ),
            $options);
    }

    public function get($prefName, $default = null)
    {
        if(!$prefName || !is_string($prefName))
        {
            throw new \InvalidArgumentException('Parameter $prefName cannot be empty and must be a string');
        }

        if(!isset($this->cachedPreferences[$prefName]))
        {
            $this->cachedPreferences[$prefName] = $this->getPreference($prefName);
        }

        $prefValue = $this->cachedPreferences[$prefName] === null ? $default : $this->cachedPreferences[$prefName];

        return $prefValue;
    }

    public function all()
    {
        $prefs = $this->dm->createQueryBuilder(SystemPreference::CLASS_NAME)
                          ->getQuery()
                          ->execute();

        $normalized = array();
        foreach($prefs as $pref)
        {
            $normalized[$pref->name] = $pref->getValue();
        }

        return $normalized;
    }

    public function multiGet()
    {
        $args = func_get_args();
        if(!$args)
        {
            throw new \InvalidArgumentException('Parameter list can not be empty');
        }

        $result = array();
        foreach($args as $prefName)
        {
            $value = $this->get($prefName);
            $result[] = $value;
        }

        return $result;
    }

    protected function getPreference($prefName)
    {
        $cacheKey = $this->options['system_preference_cache_key'];
        $value = $this->redis->hget($cacheKey, $prefName);
        if($value !== null)
        {
            $pref = unserialize($value);
            $value = $pref->serialized ? unserialize($pref->data) : $pref->data;
            return $value;
        }

        $pref = $this->dm->find(SystemPreference::CLASS_NAME, $prefName);
        if(!$pref)
        {
            $this->logger->warn(sprintf('access non-existance system preference: %s', $prefName));
            return null;
        }

        $this->logger->debug("cache miss! pref={$prefName}");

        // 把配置对象序列化后存进缓存
        $serializedPref = serialize($pref);
        $this->redis->hset($cacheKey, $prefName, $serializedPref);
        if($lifeTime = $this->options['system_preference_cache_life_time'])
        {
            $this->redis->expire($cacheKey, (int)$lifeTime);
        }

        $value = $pref->serialized ? unserialize($pref->data) : $pref->data;

        return $value;
    }

    public function set($prefName, $value)
    {
        if(!$prefName || !is_string($prefName))
        {
            throw new \InvalidArgumentException('Parameter $prefName cannot be empty and must be a string');
        }

        $serialized = false;
        $serializedValue = $value;
        if(is_object($value) || is_array($value))
        {
            $serializedValue = serialize($value);
            $serialized = true;
        }

        $pref = $this->dm->find(SystemPreference::CLASS_NAME, $prefName);
        if($pref && $pref->data === $serializedValue) // 要设置的值和原来的相同，则跳过
        {
            return;
        }
        elseif($pref)
        {
            $pref->serialized = $serialized;
            $pref->data = $serializedValue;
        }
        else
        {
            $pref = new SystemPreference();
            $pref->name = $prefName;
            $pref->data = $serializedValue;
            $pref->serialized = $serialized;
        }

        $this->dm->persist($pref);
        $this->dm->flush();

        $this->cachedPreferences[$prefName] = $value;

        $serializedPref = serialize($pref);
        $cacheKey = $this->options['system_preference_cache_key'];
        $this->redis->hset($cacheKey, $prefName, $serializedPref);
        if($lifeTime = $this->options['system_preference_cache_life_time'])
        {
            $this->redis->expire($cacheKey, (int)$lifeTime);
        }
    }
}
