<?php

namespace SaigonTechnology\Behavior\Api\Data;


use Magento\Framework\Data\SearchResultInterface;

interface BehaviorSearchResultsInterface extends SearchResultInterface
{
    /**
     * @return BehaviorInterface[]
     */
    public function getItems(): array;

    /**
     * @param BehaviorInterface[] $items
     * @return BehaviorSearchResultsInterfaceFactory
     */
    public function setItems(array $items): BehaviorSearchResultsInterfaceFactory;
}
