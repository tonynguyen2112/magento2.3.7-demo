<?php

namespace SaigonTechnology\Behavior\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Behavior extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'behavior_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('behavior', 'id');
        $this->_useIsObjectNew = true;
    }
}
