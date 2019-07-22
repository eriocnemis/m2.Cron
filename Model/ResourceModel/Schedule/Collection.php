<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Model\ResourceModel\Schedule;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use \Eriocnemis\Cron\Model\ResourceModel\Schedule as ScheduleResource;
use \Eriocnemis\Cron\Model\Schedule;

/**
 * Schedule collection
 */
class Collection extends AbstractCollection
{
    /**
     * Name prefix of events that are dispatched by model
     *
     * @var string
     */
    protected $_eventPrefix = 'eriocnemis_cron_schedule_collection';

    /**
     * Name of event parameter
     *
     * @var string
     */
    protected $_eventObject = 'collection';

    /**
     * Initialize model and resource
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Schedule::class, ScheduleResource::class);
    }

    /**
     * Limit collection by expire date
     *
     * @param string $interval
     * @return $this
     */
    public function addExpireDateFilter($interval)
    {
        $this->getSelect()->where(
            "scheduled_at <= NOW() - INTERVAL ? DAY",
            $interval
        );
        return $this;
    }
}
