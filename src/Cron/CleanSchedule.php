<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Cron;

use \Magento\Framework\App\Config\Storage\WriterInterface;
use \Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use \Eriocnemis\Cron\Model\ResourceModel\Schedule\CollectionFactory as ScheduleCollectionFactory;
use \Eriocnemis\Cron\Helper\Data as Helper;

/**
 * Clean schedule job
 */
class CleanSchedule
{
    /**
     * Last clean config path
     */
    const XML_LAST_CLEAN = 'system/cron_clean/last_clean';

    /**
     * @var ScheduleCollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var WriterInterface
     */
    protected $configWriter;

    /**
     * @var TimezoneInterface
     */
    protected $localeDate;

    /**
     * @var Helper
     */
    protected $helper;

    /**
     * Initialize job
     *
     * @param ScheduleCollectionFactory $collectionFactory
     * @param Helper $helper
     * @param WriterInterface $configWriter
     * @param TimezoneInterface $localeDate
     */
    public function __construct(
        ScheduleCollectionFactory $collectionFactory,
        Helper $helper,
        WriterInterface $configWriter,
        TimezoneInterface $localeDate
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->helper = $helper;
        $this->configWriter = $configWriter;
        $this->localeDate = $localeDate;
    }

    /**
     * Clean schedule
     *
     * @return void
     */
    public function execute()
    {
        $statuses = $this->helper->getStatuses();
        if ($this->helper->isCleanEnabled() && 0 < count($statuses)) {
            $this->deleteExpire($statuses);
            $this->updateLastClean();
        }
    }

    /**
     * Delete expire schedule
     *
     * @param string[] $statuses
     * @return void
     */
    protected function deleteExpire(array $statuses)
    {
        $collection = $this->collectionFactory->create();
        $collection->addExpireDateFilter($this->helper->getDays());
        $collection->addFieldToFilter('status', ['in' => $statuses]);
        $collection->walk('delete');
    }

    /**
     * Update last clean
     *
     * @return void
     */
    protected function updateLastClean()
    {
        $this->configWriter->save(
            self::XML_LAST_CLEAN,
            $this->localeDate->formatDate()
        );
    }
}
