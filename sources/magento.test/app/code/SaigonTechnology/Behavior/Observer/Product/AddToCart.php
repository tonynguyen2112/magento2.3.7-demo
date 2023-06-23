<?php

namespace SaigonTechnology\Behavior\Observer\Product;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use SaigonTechnology\Behavior\Api\BehaviorRepositoryInterface;
use SaigonTechnology\Behavior\Api\Data\BehaviorInterface;
use SaigonTechnology\Behavior\Model\Behavior;

class AddToCart implements ObserverInterface
{
    const TYPE_BEHAVIOR_OF_PRODUCT_ADD_TO_CART = 'add_to_cart';

    /**
     * @var BehaviorRepositoryInterface
     */
    protected $behaviorRepository;

    /**
     * @var BehaviorInterface
     */
    protected $behavior;

    public function __construct(
        BehaviorRepositoryInterface $behaviorRepository,
        BehaviorInterface $behavior
    ) {
        $this->behaviorRepository = $behaviorRepository;
        $this->behavior = $behavior;
    }

    /**
     * Below is the method that will fire whenever the event runs!
     *
     * @param Observer $observer
     * @throws LocalizedException
     */
    public function execute(Observer $observer)
    {
        $product = $observer->getProduct();

        $this->behavior->setProductId($product->getId());
        $this->behavior->setType(self::TYPE_BEHAVIOR_OF_PRODUCT_ADD_TO_CART);

        $this->behaviorRepository->save($this->behavior);
    }
}
