<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Controller\Adminhtml;

use \Magento\Framework\App\Response\Http\FileFactory;
use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Psr\Log\LoggerInterface;
use \Eriocnemis\Cron\Model\ResourceModel\Job\CollectionFactory as JobCollectionFactory;

/**
 * Job abstract controller
 */
abstract class Job extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Backend::cron_job';

    /**
     * Job collection factory
     *
     * @var JobCollectionFactory
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
     * Initialize controller
     *
     * @param Context $context
     * @param LoggerInterface $logger
     * @param JobCollectionFactory $collectionFactory
     * @param FileFactory $fileFactory
     */
    public function __construct(
        Context $context,
        LoggerInterface $logger,
        JobCollectionFactory $collectionFactory,
        FileFactory $fileFactory
    ) {
        $this->logger = $logger;
        $this->collectionFactory = $collectionFactory;
        $this->fileFactory = $fileFactory;

        parent::__construct(
            $context
        );
    }
}
