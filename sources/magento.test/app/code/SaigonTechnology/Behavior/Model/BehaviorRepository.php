<?php

namespace SaigonTechnology\Behavior\Model;

use SaigonTechnology\Behavior\Api\Data\BehaviorInterfaceFactory;
use SaigonTechnology\Behavior\Api\Data\BehaviorSearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use SaigonTechnology\Behavior\Api\BehaviorRepositoryInterface;
use SaigonTechnology\Behavior\Api\Data\BehaviorInterface;
use SaigonTechnology\Behavior\Model\ResourceModel\Behavior as ResourceBehavior;
use SaigonTechnology\Behavior\Model\ResourceModel\Behavior\Collection as BehaviorCollectionFactory;

class BehaviorRepository implements BehaviorRepositoryInterface
{
    /**
     * @var ResourceBehavior
     */
    private $resource;

    public function __construct(ResourceBehavior $resource)
    {
        $this->resource = $resource;
    }

    public function save(BehaviorInterface $behavior): BehaviorInterface
    {
        try {
            $this->resource->save($behavior);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Could not save the Behavior.'), $exception);
        }
        return $behavior;
    }
}
