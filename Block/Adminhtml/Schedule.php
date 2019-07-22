<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Block\Adminhtml;

use \Magento\Backend\Block\Widget\Grid\Container;

/**
 * Schedule block
 *
 * @api
 */
class Schedule extends Container
{
    /**
     * Initialize block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_blockGroup = 'Eriocnemis_Cron';
        $this->_controller = 'adminhtml';
        $this->_headerText = __('Schedules');

        parent::_construct();
        $this->buttonList->remove('add');
    }
}
