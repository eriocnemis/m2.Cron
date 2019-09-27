<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Controller\Adminhtml\Schedule;

use Magento\Framework\App\ResponseInterface;
use Eriocnemis\Cron\Controller\Adminhtml\Schedule as Action;

/**
 * Schedule index controller
 */
class Index extends Action
{
    /**
     * Schedules list
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'Eriocnemis_Cron::cron_schedule'
        );
        $this->_view->getPage()->getConfig()->getTitle()->prepend(
            __('Schedules')
        );
        $this->_view->renderLayout();
    }
}
