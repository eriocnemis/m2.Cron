<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Model\ResourceModel\Job;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use \Eriocnemis\Cron\Model\ResourceModel\Job as JobResource;
use \Eriocnemis\Cron\Model\Job;

/**
 * Job collection
 */
class Collection extends AbstractCollection
{
    /**
     * Identifier field name for collection items
     *
     * @var string
     */
    protected $_idFieldName = 'name';

    /**
     * Name prefix of events that are dispatched by model
     *
     * @var string
     */
    protected $_eventPrefix = 'eriocnemis_cron_job_collection';

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
        $this->_init(Job::class, JobResource::class);
    }
}
