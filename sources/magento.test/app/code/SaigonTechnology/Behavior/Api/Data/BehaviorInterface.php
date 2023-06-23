<?php

namespace SaigonTechnology\Behavior\Api\Data;

use Magento\Framework\Stdlib\DateTime\DateTime;

interface BehaviorInterface
{
    const BEHAVIOR_ID = 'id';
    const TYPE = 'type';
    const PRODUCT_ID = 'product_id';
    const CREATED = 'created_at';
    const UPDATED = 'updated_at';

    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @param mixed $value
     */
    public function setId($value): BehaviorInterface;

    /**
     * @return string|null
     */
    public function getType(): ?string;

    /**
     * @param string $type
     */
    public function setType(string $type): BehaviorInterface;

    /**
     * @return int|null
     */
    public function getProductId(): ?int;

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): BehaviorInterface;

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime;

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): BehaviorInterface;

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime;

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): BehaviorInterface;
}
