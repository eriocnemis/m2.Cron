<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Model;

use \Magento\Framework\Model\AbstractModel;
use \Eriocnemis\Cron\Model\ResourceModel\Job as JobResource;

/**
 * Job model
 *
 * @method Job setName(string $name)
 * @method string getName()
 * @method Job setGroup(string $group)
 * @method string getGroup()
 * @method Job setSchedule(string $schedule)
 * @method string getSchedule()
 * @method Job setModule(string $module)
 * @method string getModule()
 * @method Job setInstance(string $instance)
 * @method string getInstance()
 * @method Job setMethod(string $method)
 * @method string getMethod()
 * @method Job setStatus(int $status)
 * @method int getStatus()
 */
class Job extends AbstractModel
{
    /**
     * Name prefix of events that are dispatched by model
     *
     * @var string
     */
    protected $_eventPrefix = 'eriocnemis_cron_job';

    /**
     * Name of event parameter
     *
     * @var string
     */
    protected $_eventObject = 'job';

    /**
     * Model construct that should be used for object initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(JobResource::class);
    }
}
