<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Block\Adminhtml\Widget\Grid;

use \Magento\Backend\Block\Widget\Grid\Massaction as AbstractMassaction;

/**
 * Widget massaction
 *
 * @api
 */
class Massaction extends AbstractMassaction
{
    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        $params['form_key'] = null;
        if (empty($params['_current'])) {
            $params['_current'] = true;
        }
        return parent::getUrl($route, $params);
    }
}
