<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Controller\Adminhtml\Schedule;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\LocalizedException;
use Eriocnemis\Cron\Controller\Adminhtml\Schedule as Action;

/**
 * Schedule mass delete controller
 */
class MassDelete extends Action
{
    /**
     * Delete specified schedules
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection(
                $this->collectionFactory->create()
            );

            $size = $collection->getSize();
            if (!$size) {
                $this->messageManager->addError(
                    __('Please correct the schedules you requested.')
                );
                return $this->_redirect('*/*/*');
            }

            $collection->walk('delete');

            $this->messageManager->addSuccess(
                __('You deleted a total of %1 records.', $size)
            );
        } catch (LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addError(
                __('We can\'t delete these schedules right now. Please review the log and try again.')
            );
            $this->logger->critical($e);
        }
        $this->_redirect('*/*/index', ['_current' => true]);
    }
}
