<?php

namespace SaigonTechnology\Behavior\Model\ResourceModel\Behavior;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use SaigonTechnology\Behavior\Model\Behavior as Model;
use SaigonTechnology\Behavior\Model\ResourceModel\Behavior as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'behavior_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
