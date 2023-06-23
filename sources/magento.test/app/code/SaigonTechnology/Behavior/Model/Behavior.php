<?php

namespace SaigonTechnology\Behavior\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractExtensibleModel;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Tests\NamingConvention\true\mixed;
use SaigonTechnology\Behavior\Api\Data\BehaviorInterface;
use SaigonTechnology\Behavior\Model\ResourceModel\Behavior as ResourceModel;

class Behavior extends AbstractExtensibleModel implements BehaviorInterface, IdentityInterface
{
    const CACHE_TAG = 'behavior_cache';

    /**
     * @var string
     */
    protected $_eventPrefix = 'behavior_model';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $productId;

    /**
     * @var DateTime
     */
    protected $createdAt;

    /**
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return array
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->getData(self::BEHAVIOR_ID);
    }

    /**
     * @param mixed $value
     * @return BehaviorInterface
     */
    public function setId($value): BehaviorInterface
    {
        return $this->setData(self::BEHAVIOR_ID, $value);
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->getData(self::TYPE);
    }

    /**
     * @param string $type
     * @return BehaviorInterface
     */
    public function setType(string $type): BehaviorInterface
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * @param int $productId
     * @return BehaviorInterface
     */
    public function setProductId(int $productId): BehaviorInterface
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->getData(self::CREATED);
    }

    /**
     * @param DateTime $createdAt
     * @return BehaviorInterface
     */
    public function setCreatedAt(DateTime $createdAt): BehaviorInterface
    {
        return $this->setData(self::CREATED, $createdAt);
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->getData(self::UPDATED);
    }

    /**
     * @param DateTime $updatedAt
     * @return BehaviorInterface
     */
    public function setUpdatedAt(DateTime $updatedAt): BehaviorInterface
    {
        return $this->setData(self::UPDATED, $updatedAt);
    }
}
