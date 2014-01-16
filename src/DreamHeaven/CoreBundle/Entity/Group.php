<?php
namespace DreamHeaven\CoreBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="groups")
 */
class Group extends \FOS\UserBundle\Entity\Group
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(name="preference", type="string", length=255, nullable=false)
     */
    public $preference;

    public function getPreference()
    {
        return $this->preference ? unserialize($this->preference) : array();
    }

    public function setPreference(array $preference)
    {
        $this->preference = serialize($preference);
    }
}
