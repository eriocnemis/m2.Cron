<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Controller\Adminhtml\Job;

use \Magento\Framework\App\ResponseInterface;
use \Eriocnemis\Cron\Controller\Adminhtml\Job as Action;

/**
 * Job index controller
 */
class Index extends Action
{
    /**
     * Jobs list
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'Eriocnemis_Cron::cron_job'
        );
        $this->_view->getPage()->getConfig()->getTitle()->prepend(
            __('Jobs')
        );
        $this->_view->renderLayout();
    }
}
