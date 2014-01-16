<?php
namespace DreamHeaven\AdminBundle\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Lianz\SimpleFormBundle\Form;
use DreamHeaven\AdminBundle\Helper\FormHelper;

/**
 * @abstract 定义表单类
 * @author LiangZhenJing 搭建
 */
class ReportForm extends Form {
    public function __construct(ContainerInterface $container, $parameters) {
        parent::__construct($container, true);
        if(!$parameters->has('date') && $parameters->has('dt_begin')) {
            $parameters->set('date', $parameters->get('dt_begin'));
        }
        $realms = $container->get('gm_service')->getAllRealms();
        $this->registerValidator('valid_realm', FormHelper::createServerValidator($realms));
        $fieldDefs = array(
            'date'      => array('required, valid_date'),
            'dt_begin'  => array('required, valid_date'),
            'dt_end'    => array('required, valid_date'),
            'realm'     => array('required, single_realm', 'single_realm'),
        );
        $this->init($fieldDefs);
        $this->bind($parameters);
    }
}
