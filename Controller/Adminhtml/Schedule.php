<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Controller\Adminhtml;

use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Psr\Log\LoggerInterface;
use Eriocnemis\Cron\Model\ResourceModel\Schedule\CollectionFactory as ScheduleCollectionFactory;

/**
 * Schedule abstract controller
 */
abstract class Schedule extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Backend::cron_schedule';

    /**
     * Schedule collection factory
     *
     * @var ScheduleCollectionFactory
     */
    protected $collectionFactory;

    /**
     * Logger
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * File factory
     *
     * @var FileFactory
     */
    protected $fileFactory;

    /**
     * Mass action filter
     *
     * @var Filter
     */
    protected $filter;

    /**
     * Initialize controller
     *
     * @param Context $context
     * @param LoggerInterface $logger
     * @param ScheduleCollectionFactory $collectionFactory
     * @param FileFactory $fileFactory
     * @param Filter $filter
     */
    public function __construct(
        Context $context,
        LoggerInterface $logger,
        ScheduleCollectionFactory $collectionFactory,
        FileFactory $fileFactory,
        Filter $filter
    ) {
        $this->logger = $logger;
        $this->collectionFactory = $collectionFactory;
        $this->fileFactory = $fileFactory;
        $this->filter = $filter;

        parent::__construct(
            $context
        );
    }
}
