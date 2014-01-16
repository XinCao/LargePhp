<?php
namespace DreamHeaven\AdminBundle\ContentApproval\Formatter;

// <editor-fold defaultstate="collapsed" desc="use namespaces">
use Symfony\Component\DependencyInjection\ContainerInterface;
use DreamHeaven\AdminBundle\Document\PendingApprovalObject as PAO;
// </editor-fold>

class FormatterFactory
{
    /**
     * @static
     * @param $objectType
     * @return IPendingApprovalObjectFormatter
     */
    public static function create($objectType)
    {
        $objectType = preg_replace_callback ('/_([a-z])/', function($m){return ucfirst($m[1]);}, $objectType);
        $className = ucfirst($objectType);
        $fqn = "DreamHeaven\\AdminBundle\\ContentApproval\\Formatter\\{$className}Formatter";

        return new $fqn();
    }
}
