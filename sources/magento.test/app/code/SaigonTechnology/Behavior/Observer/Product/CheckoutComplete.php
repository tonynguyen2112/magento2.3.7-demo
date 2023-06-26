<?php

namespace SaigonTechnology\Behavior\Observer\Product;

use Magento\Catalog\Model\Product;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Api\OrderRepositoryInterface;
use SaigonTechnology\Behavior\Api\BehaviorRepositoryInterface;
use SaigonTechnology\Behavior\Api\Data\BehaviorInterface;
use SaigonTechnology\Behavior\Model\Behavior;

class CheckoutComplete implements ObserverInterface
{
    const TYPE_BEHAVIOR_OF_PRODUCT_CHECKOUT = 'checkout';

    /**
     * @var BehaviorRepositoryInterface
     */
    protected $behaviorRepository;

    /**
     * @var BehaviorInterface
     */
    protected $behavior;

    /**
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    public function __construct(
        BehaviorRepositoryInterface $behaviorRepository,
        BehaviorInterface $behavior,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->behaviorRepository = $behaviorRepository;
        $this->behavior = $behavior;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Below is the method that will fire whenever the event runs!
     *
     * @param Observer $observer
     * @throws LocalizedException
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();

        foreach ($order->getItems() as $orderItem) {
            $this->behavior->setProductId($orderItem->getData('product_id'));
            $this->behavior->setType(self::TYPE_BEHAVIOR_OF_PRODUCT_CHECKOUT);

            $this->behaviorRepository->save($this->behavior);
        }
    }
}
