<?php

namespace common\modules\transportlogistics\frontend\assets;

use yii\web\AssetBundle;


class TransportlogisticsAsset extends AssetBundle
{

    public $publishOptions = [
        'forceCopy' => true
    ];

    public $sourcePath = '@common/modules/transportlogistics/frontend/web';

    public $css = [
        'css/transportlogistics.css',
        'css/calendar.css',

    ];
    public $js = [
        'js/transportlogistics.js',
        'js/calendar.js',
        'js/helper.js',
        'js/core_autocomplete.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}