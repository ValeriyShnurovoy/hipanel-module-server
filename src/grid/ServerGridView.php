<?php
/**
 * @link    http://hiqdev.com/hipanel-module-server
 * @license http://hiqdev.com/hipanel-module-server/license
 * @copyright Copyright (c) 2015 HiQDev
 */

namespace hipanel\modules\server\grid;

use hipanel\widgets\ArraySpoiler;
use Yii;
use hipanel\grid\ActionColumn;
use hipanel\grid\MainColumn;
use hipanel\grid\RefColumn;
use hipanel\modules\server\widgets\DiscountFormatter;
use hipanel\modules\server\widgets\Expires;
use hipanel\modules\server\widgets\OSFormatter;
use hipanel\modules\server\widgets\State;

class ServerGridView extends \hipanel\grid\BoxedGridView
{
    /**
     * @var array
     */
    public static $osImages;

    public static function setOsImages($osImages)
    {
        static::$osImages = $osImages;
    }

    public static function defaultColumns()
    {
        $osImages = self::$osImages;

        return [
            'server'       => [
                'class'           => MainColumn::className(),
                'attribute'       => 'name',
                'filterAttribute' => 'name_like',
                'note'            => true
            ],
            'state'        => [
                'class'  => RefColumn::className(),
                'format' => 'raw',
                'gtype'  => 'state,device',
                'value'  => function ($model) {
                    $html = State::widget(compact('model'));
                    if ($model->status_time) {
                        $html .= ' ' . Yii::t('app', 'since') . ' ' . Yii::$app->formatter->asDate($model->status_time);
                    }
                    return $html;
                },
            ],
            'panel'        => [
                'attribute'      => 'panel',
                'format'         => 'text',
                'contentOptions' => ['class' => 'text-uppercase'],
                'value'          => function ($model) {
                    return $model->panel ?: '';
                }
            ],
            'os'           => [
                'attribute' => 'os',
                'format'    => 'raw',
                'value'     => function ($model) use ($osImages) {
                    return OSFormatter::widget([
                        'osimages'  => $osImages,
                        'imageName' => $model->osimage
                    ]);
                }
            ],
            'os_and_panel' => [
                'format' => 'raw',
                'value'  => function ($model) use ($osImages) {
                    $html = OSFormatter::widget([
                        'osimages'  => $osImages,
                        'imageName' => $model->osimage
                    ]);
                    $html .= ' ' . $model->panel ?: '';
                    return $html;
                }
            ],
            'discount'     => [
                'attribute'     => 'discount',
                'format'        => 'raw',
                'headerOptions' => ['style' => 'width: 1em'],
                'value'         => function ($model) {
                    return DiscountFormatter::widget([
                        'current' => $model->discounts['fee']['current'],
                        'next'    => $model->discounts['fee']['next'],
                    ]);
                }
            ],
            'actions'      => [
                'class'    => ActionColumn::className(),
                'template' => '{view}',
                'header'   => Yii::t('app', 'Actions'),
            ],
            'expires'      => [
                'filter'        => false,
                'format'        => 'raw',
                'headerOptions' => ['style' => 'width: 1em'],
                'value'         => function ($model) {
                    return Expires::widget(compact('model'));
                },
            ],
            'tariff'       => [
                'attribute' => 'tariff',
            ],
            'tariff_note'  => [
                'attribute' => 'tariff_note'
            ],
            'ips'          => [
                'attribute' => 'ips',
                'format'    => 'raw',
                'value'     => function ($model) {
                    return ArraySpoiler::widget([
                        'data' => $model->ips
                    ]);
                }
            ],
            'sale_time'    => [
                'attribute' => 'sale_time',
                'format'    => 'date',
            ]
        ];
    }
}
