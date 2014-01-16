<?php
namespace DreamHeaven\CoreBundle\Model;

class SmartModel
{
    public function &__get($property) {
        if(!property_exists($this, $property))
        {
            throw new \InvalidArgumentException('Property ' . $property . ' not exists');
        }
        
        return $this->$property;
    }

    public function __set($property, $value) {
        if(!property_exists($this, $property))
        {
            throw new \InvalidArgumentException('Property ' . $property . ' not exists');
        }

        $this->$property = $value;
        return $this;
    }

    public function toArray()
    {
        $properties = get_object_vars($this);

        $fields = func_get_args();
        $fields = $fields ?: array_keys($properties);

        $filtered_properties = array();
        foreach($fields as $field)
        {
            if(!property_exists($this, $field))
            {
                throw new \InvalidArgumentException('Property ' . $field . ' not exists');
            }

            $value = $properties[$field];

            // 如果值是空（null, false, "", 0, 空数组([])，均不生成json）
            if(empty($value))
            {
                continue;
            }

            $filtered_properties[$field] = $value;
        }

        return $filtered_properties;
    }

    public function __isset($property)
    {
        return isset($this->$property);
    }

    public function __unset($property)
    {
        if(!property_exists($this, $property))
        {
            throw new \InvalidArgumentException('Property ' . $property . ' not exists');
        }

        $this->$property = null;
    }


}
