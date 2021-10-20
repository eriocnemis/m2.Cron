<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Controller\Adminhtml\Schedule;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Eriocnemis\Cron\Controller\Adminhtml\Schedule as Action;

/**
 * Schedule index controller
 */
class Index extends Action
{
    /**
     * Schedules list
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $result->setActiveMenu('Eriocnemis_Cron::cron_schedule');

        $title = $result->getConfig()->getTitle();
        $title->prepend((string)__('Schedules'));

        return $result;
    }
}
