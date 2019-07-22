<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Model\Config\Source;

use \Magento\Framework\Option\ArrayInterface;
use \Magento\Cron\Model\ConfigInterface;

/**
 * Group source
 */
class Group implements ArrayInterface
{
    /**
     * Config options
     *
     * @var array
     */
    protected $options;

    /**
     * Cron job config
     *
     * @var ConfigInterface
     */
    protected $config;

    /**
     * Initialize source
     *
     * @param ConfigInterface $config
     */
    public function __construct(
        ConfigInterface $config
    ) {
        $this->config = $config;
    }

    /**
     * Retrieve config options
     *
     * @return array
     */
    public function toOptionArray()
    {
        if (null == $this->options) {
            foreach ($this->config->getJobs() as $group => $jobs) {
                $this->options[] = ['label' => $group, 'value' => $group];
            }
        }
        return $this->options;
    }
}
