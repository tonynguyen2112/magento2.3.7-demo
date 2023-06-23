<?php

namespace SaigonTechnology\Behavior\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use SaigonTechnology\Behavior\Api\Data\BehaviorInterface;
use SaigonTechnology\Behavior\Api\Data\BehaviorSearchResultsInterfaceFactory;

interface BehaviorRepositoryInterface
{
    /**
     * Save behavior.
     *
     * @param BehaviorInterface $behavior
     * @return BehaviorInterface
     * @throws LocalizedException
     */
    public function save(BehaviorInterface $behavior): BehaviorInterface;
}
