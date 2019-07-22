<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Model;

use \Magento\Framework\Model\AbstractModel;
use \Eriocnemis\Cron\Model\ResourceModel\Schedule as ScheduleResource;

/**
 * Schedule model
 *
 * @method Schedule setJobCode(string $jobCode)
 * @method string getJobCode()
 * @method Schedule setStatus(string $status)
 * @method string getStatus()
 * @method Schedule setMessages(string $messages)
 * @method string getMessages()
 * @method Schedule setCreatedAt(string $createdAt)
 * @method string getCreatedAt()
 * @method Schedule setScheduledAt(string $scheduledAt)
 * @method string getScheduledAt()
 * @method Schedule setExecutedAt(string $executedAt)
 * @method string getExecutedAt()
 * @method Schedule setFinishedAt(string $finishedAt)
 * @method string getFinishedAt()
 */
class Schedule extends AbstractModel
{
    /**
     * Name prefix of events that are dispatched by model
     *
     * @var string
     */
    protected $_eventPrefix = 'eriocnemis_cron_schedule';

    /**
     * Name of event parameter
     *
     * @var string
     */
    protected $_eventObject = 'schedule';

    /**
     * Model construct that should be used for object initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ScheduleResource::class);
    }
}
