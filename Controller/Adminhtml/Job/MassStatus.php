<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Controller\Adminhtml\Job;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\LocalizedException;
use Eriocnemis\Cron\Controller\Adminhtml\Job as Action;

/**
 * Job change status controller
 */
class MassStatus extends Action
{
    /**
     * Change statuses of specific jobs
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
                    __('Please correct the jobs you requested.')
                );
                return $this->_redirect('*/*/*');
            }

            $status = (int)$this->getRequest()->getParam('status');
            $collection->setDataToAll('status', $status);
            $collection->walk('save');

            $this->messageManager->addSuccess(
                __('You updated a total of %1 records.', $size)
            );
        } catch (LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addError(
                __('Something went wrong while updating the job(s) status. Please review the log and try again.')
            );
            $this->logger->critical($e);
        }
        $this->_redirect('*/*/index', ['_current' => true]);
    }
}
