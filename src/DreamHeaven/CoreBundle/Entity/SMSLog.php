<?php
namespace DreamHeaven\CoreBundle\Entity;
use DreamHeaven\CoreBundle\Model\SmartModel;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sms_logs")
 */
class SMSLog extends SmartModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $mobile;
    
    /** @ORM\Column(type="string") */
    protected $content;
    
    /** @ORM\Column(type="string") */
    protected $response_code;

    /** @ORM\Column(type="string") */
    protected $response_msgid;

    /** @ORM\Column(type="string") */
    protected $response;
        
    /** @ORM\Column(type="integer", length=10) */
    protected $created_at;
}
