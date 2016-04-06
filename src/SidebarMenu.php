<?php

/*
 * Server module for HiPanel
 *
 * @link      https://github.com/hiqdev/hipanel-module-server
 * @package   hipanel-module-server
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\server;

use Yii;

class SidebarMenu extends \hipanel\base\Menu implements \yii\base\BootstrapInterface
{
    protected $_addTo = 'sidebar';

    protected $_where = [
        'after'     => ['domains', 'tickets', 'finance', 'clients', 'dashboard'],
        'before'    => ['hosting'],
    ];

    public function items()
    {
        return [
            'servers' => [
                'label' => Yii::t('hipanel/server', 'Servers'),
                'url'   => ['/server/server/index'],
                'icon'  => 'fa-server',
                'items' => [
                    'servers' => [
                        'label' => Yii::t('hipanel/server', 'Servers'),
                        'url'   => ['/server/server/index'],
                    ],
                ],
            ],
        ];
    }
}
