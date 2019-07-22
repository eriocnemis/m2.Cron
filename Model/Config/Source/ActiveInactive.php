<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Model\Config\Source;

use \Magento\Framework\Option\ArrayInterface;

/**
 * ActiveInactive source
 */
class ActiveInactive implements ArrayInterface
{
    /**
     * Retrieve config options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['label' => __('Active'), 'value' => '1'],
            ['label' => __('Inactive'), 'value' => '0']
        ];
    }
}
