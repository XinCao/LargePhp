<?php
namespace DreamHeaven\CoreBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use DreamHeaven\CoreBundle\Model\SmartModel;

/** 
 * @MongoDB\Document(collection="system_preferences", repositoryClass="DreamHeaven\CoreBundle\Repository\SystemPreferenceRepository")
 */
class SystemPreference extends SmartModel
{
    const CLASS_NAME = __CLASS__;

    /** @MongoDB\Id(strategy="NONE") */
    public $name;

    /** @MongoDB\Boolean */
	public $serialized = false;

    /** @MongoDB\String */
	public $title;

    /** @MongoDB\String */
	public $description;

    /** @MongoDB\String */
	public $group_name;

    /** @MongoDB\String */
	public $data;

    public function getValue()
    {
        if($this->serialized)
            return unserialize($this->data);
        else
            return $this->data;
    }

    public function setValue($value)
    {
        if(is_object($value) || is_array($value))
            $this->data = serialize($value);
        else
            $this->data = $value;
    }
}

