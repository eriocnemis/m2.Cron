<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Plugin\Cron\Model;

use Magento\Cron\Model\Config as Subject;
use Eriocnemis\Cron\Model\ResourceModel\Job\CollectionFactory as JobCollectionFactory;

/**
 * Config plugin
 */
class Config
{
    /**
     * Job collection factory
     *
     * @var JobCollectionFactory
     */
    protected $collectionFactory;

    /**
     * Initialize plugin
     *
     * @param JobCollectionFactory $collectionFactory
     */
    public function __construct(
        JobCollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Retrieve cron full cron jobs
     *
     * @param Subject $subject
     * @param array $result
     * @return array
     */
    public function afterGetJobs(Subject $subject, $result)
    {
        $jobIds = $this->getInactiveIds();
        if (0 < count($jobIds)) {
            return $this->prepareResult($result, $jobIds);
        }
        return $result;
    }

    /**
     * Retrieve prepared result
     *
     * @param array $result
     * @param array $jobIds
     * @return array
     */
    protected function prepareResult(array $result, array $jobIds)
    {
        foreach ($result as $group => $jobs) {
            foreach ($jobs as $name => $data) {
                if (in_array($name, $jobIds)) {
                    unset($result[$group][$name]);
                }
            }
        }
        return $result;
    }

    /**
     * Retrieve disable job ids
     *
     * @return array
     */
    protected function getInactiveIds()
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('status', ['eq' => 0]);
        return $collection->getAllIds();
    }
}
