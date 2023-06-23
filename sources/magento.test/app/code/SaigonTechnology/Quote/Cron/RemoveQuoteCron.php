<?php

namespace SaigonTechnology\Quote\Cron;

use Exception;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Quote\Api\CartRepositoryInterface;
use Psr\Log\LoggerInterface;

class RemoveQuoteCron
{
    const MAX_DAY_TO_KEEP_OLD_QUOTES_KEY = 'SaigonTechnology_Quote/options/max_day_to_keep_old_quotes';
    const IS_ENABLE_MAX_DAY_TO_KEEP_OLD_QUOTES_KEY = 'SaigonTechnology_Quote/options/enable';

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * @var ScopeConfigInterface
     */
    protected $config;

    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;

    /**
     * @param LoggerInterface $logger
     * @param CartRepositoryInterface $quoteRepository
     * @param ScopeConfigInterface $config
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        LoggerInterface $logger,
        CartRepositoryInterface $quoteRepository,
        ScopeConfigInterface $config,
        ResourceConnection $resourceConnection
    ) {
        $this->logger = $logger;
        $this->quoteRepository = $quoteRepository;
        $this->config = $config;
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * Write to system.log
     *
     * @return void
     * @throws Exception
     */
    public function execute()
    {
        $this->logger->info('--------------Cron Quote Start-------------------');

        if ((int) $this->config->getValue(self::IS_ENABLE_MAX_DAY_TO_KEEP_OLD_QUOTES_KEY) === 0) {
            return;
        }

        $maxDay = $this->config->getValue(self::MAX_DAY_TO_KEEP_OLD_QUOTES_KEY);

        $datetime = new \DateTime('now');
        $datetime = $datetime->sub(new \DateInterval('P' . $maxDay . 'D'))->format('Y-m-d H:i:s');

        $table = $this->resourceConnection->getTableName('quote');
        $this->resourceConnection->getConnection()->delete($table, ["updated_at <= '$datetime'"]);

        $this->logger->info('--------------Cron Quote End-------------------');
    }
}
