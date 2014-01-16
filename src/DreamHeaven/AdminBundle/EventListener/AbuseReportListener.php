<?php
namespace DreamHeaven\AdminBundle\EventListener;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bridge\Monolog\Logger;

use DreamHeaven\HuashuoBundle\Document as D;
use DreamHeaven\HuashuoBundle\Event\EventArgs as E;
use DreamHeaven\AdminBundle\Document\PendingApprovalObject as PAO;

class AbuseReportListener
{
    /** @var DocumentManager */
    protected $dm;
    /** @var Logger */
    protected $logger;

    protected $options = array();

    public function __construct(DocumentManager $dm, Logger $logger = null, $options = array())
    {
        $this->dm      = $dm;
        $this->logger  = $logger;
        $this->options = array_merge(array(), $options);
    }

    public function onAbuseReported(E\AbuseReportedEventArgs $e)
    {
        $report = $e->abuse_report;

        $pao              = new PAO();
        $pao->reporter_id = $report->reporter_id;
        $pao->object_id   = $report->target_id;
        $pao->object_type = $report->target_type;
        $pao->reason      = $report->content;
        $pao->processed   = false;
        $pao->created_at  = $now = time();
        $pao->updated_at  = $now;

        $this->dm->persist($pao);
        $this->dm->flush();
    }
}
