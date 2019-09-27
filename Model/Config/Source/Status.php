<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Magento\Cron\Model\Schedule;

/**
 * Status source
 */
class Status implements ArrayInterface
{
    /**
     * Retrieve config options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['label' => __('Pending'), 'value' => Schedule::STATUS_PENDING],
            ['label' => __('Running'), 'value' => Schedule::STATUS_RUNNING],
            ['label' => __('Success'), 'value' => Schedule::STATUS_SUCCESS],
            ['label' => __('Missed'), 'value' => Schedule::STATUS_MISSED],
            ['label' => __('Error'), 'value' => Schedule::STATUS_ERROR]
        ];
    }
}
