<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Helper;

use \Magento\Store\Model\ScopeInterface;
use \Magento\Framework\App\Helper\AbstractHelper;

/**
 * Helper
 */
class Data extends AbstractHelper
{
    /**
     * Clean enabled config path
     */
    const XML_CLEAN_ENABLED = 'system/cron_clean/clean';

    /**
     * Clean statuses list config path
     */
    const XML_STATUS = 'system/cron_clean/status';

    /**
     * Days config path
     */
    const XML_DAYS = 'system/cron_clean/days';

    /**
     * Check clean functionality should be enabled
     *
     * @param string $storeId
     * @return bool
     */
    public function isCleanEnabled($storeId = null)
    {
        return $this->isSetFlag(static::XML_CLEAN_ENABLED, $storeId);
    }

    /**
     * Retrieve statuses list
     *
     * @param string $storeId
     * @return string[]
     */
    public function getStatuses($storeId = null)
    {
        return explode(',', $this->getValue(static::XML_STATUS, $storeId));
    }

    /**
     * Retrieve days
     *
     * @param string $storeId
     * @return string
     */
    public function getDays($storeId = null)
    {
        return $this->getValue(self::XML_DAYS, $storeId);
    }

    /**
     * Retrieve config value by path and scope
     *
     * @param string $path
     * @param string $storeId
     * @return mixed
     */
    protected function getValue($path, $storeId = null)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * Retrieve config flag
     *
     * @param string $path
     * @param string $storeId
     * @return bool
     */
    protected function isSetFlag($path, $storeId = null)
    {
        return $this->scopeConfig->isSetFlag($path, ScopeInterface::SCOPE_STORE, $storeId);
    }
}
