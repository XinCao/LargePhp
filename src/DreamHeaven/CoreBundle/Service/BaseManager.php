<?php
namespace DreamHeaven\CoreBundle\Service;

use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

class BaseManager extends Service
{
    /** @var DocumentManager */
    protected $dm;
    /** @var \Symfony\Bridge\Monolog\Logger */
    protected $logger;

    protected $class;

    public function __construct(DocumentManager $dm, LoggerInterface $logger, $class)
    {
        $this->dm     = $dm;
        $this->logger = $logger;
        $this->class  = $class;
    }

    public function count($filters = array())
    {
        $query = $this->buildQuery(0, 0, $filters, array(), array(), array());
        $cursor = $query->execute();

        $total = $cursor->count();

        return $total;
    }

    public function paginate($limit = 20, $offset = 0, $filters = array(), $sort = array(), $fields = array(), $options = array())
    {
        $query = $this->buildQuery($limit, $offset, $filters, $sort, $fields, $options);
        $cursor = $query->execute();

        $total = $cursor->count();
        $objects = $cursor->toArray();

        return array($objects, $total);
    }

    protected function buildQuery($limit, $offset, $filters, $sort, $fields, $options)
    {
        $builder = $this->dm->createQueryBuilder($this->class);

        $builder->limit($limit);
        if($offset)
        {
            $builder->skip($offset);
        }

        if(is_array($filters))
        {
            foreach ($filters as $field => $value)
            {
                if(is_array($value))
                {
                    foreach ($value as $op => $opArgs)
                    {
                        $builder->field($field)->$op($opArgs);
                    }
                }
                else
                {
                    $builder->field($field)->equals($value);
                }
            }
        }

        if($sort)
        {
            $builder->sort($sort);
        }

        if($fields)
        {
            call_user_func_array(array($builder, 'select'), $fields);
        }

        $slaveOkay = isset($options['slaveOkay']) ? $options['slaveOkay'] : true;
        $builder->slaveOkay($slaveOkay);

        $hydrate = isset($options['hydrate']) ? $options['hydrate'] : true;
        $builder->hydrate($hydrate);

        $query = $builder->getQuery();

        return $query;
    }
}
