<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Controller\Adminhtml\Job;

use \Magento\Framework\App\ResponseInterface;
use \Magento\Framework\App\Filesystem\DirectoryList;
use \Magento\Backend\Block\Widget\Grid\ExportInterface;
use \Eriocnemis\Cron\Controller\Adminhtml\Job as Action;

/**
 * Job export controller
 */
class ExportCsv extends Action
{
    /**
     * Export job grid to CSV format
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $fileName = 'jobs.csv';
        /** @var ExportInterface $exportBlock */
        $exportBlock = $this->_view->getLayout()->getChildBlock(
            'cron.job.grid',
            'grid.export'
        );

        return $this->fileFactory->create(
            $fileName,
            $exportBlock->getCsvFile(),
            DirectoryList::VAR_DIR
        );
    }
}
