<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Controller\Adminhtml\Schedule;

use \Magento\Framework\App\ResponseInterface;
use \Magento\Framework\App\Filesystem\DirectoryList;
use \Magento\Backend\Block\Widget\Grid\ExportInterface;
use \Eriocnemis\Cron\Controller\Adminhtml\Schedule as Action;

/**
 * Schedule export controller
 */
class ExportXml extends Action
{
    /**
     * Export schedule grid to XML format
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $fileName = 'schedules.xml';
        /** @var ExportInterface $exportBlock */
        $exportBlock = $this->_view->getLayout()->getChildBlock(
            'cron.schedule.grid',
            'grid.export'
        );

        return $this->fileFactory->create(
            $fileName,
            $exportBlock->getExcelFile($fileName),
            DirectoryList::VAR_DIR
        );
    }
}
