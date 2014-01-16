<?php
namespace DreamHeaven\CoreBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser {
    const CLASS_NAME = __CLASS__;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(name="group_id", type="integer")
     */
    public $groupId;

    /**
     * @var string $confirmationEmailToken
     *
     * @ORM\Column(name="confirmation_email_token", type="string", length=255, nullable=true)
     */
    public $confirmationEmailToken;

    /**
     * @var string $registeIP
     *
     * @ORM\Column(name="registe_ip", type="string", length=255, nullable=true)
     */
    public $registeIP;

    /**
     * @var string $lastLoginIP
     *
     * @ORM\Column(name="last_login_ip", type="string", length=255, nullable=true)
     */
    public $lastLoginIP;

    /**
     * @ORM\Column(name="mobile", type="string", length=20, nullable=true, unique=true)
     */
    public $mobile;

    /**
     * @ORM\Column(name="display_name", type="string", length=255, nullable=true)
     */
    public $display_name;

    public function getDisplayName() {
        return $this->display_name;
    }

    public function setDisplayName($name) {
        $this->display_name = $name;
    }

    public function __get($property) {
        if(!property_exists($this, $property)) {
            throw new InvalidArgumentException('Property ' . $property . ' not exists');
        }
        return $this->$property;
    }

    public function __set($property, $value) {
        if(!property_exists($this, $property)) {
            throw new InvalidArgumentException('Property ' . $property . ' not exists');
        }
        $this->$property = $value;
        return $this;
    }

    public function isValid() {
        $isValid = $this->isEnabled() || !$this->isLocked() || !$this->isExpired() || !$this->isCredentialsExpired();
        return $isValid;
    }

    public function toArray() {
        $data = array();
        $fields = func_get_args();
        foreach ($fields as $field) {
            $data[$field] = $this->$field;
        }
        return $data;
    }
}
