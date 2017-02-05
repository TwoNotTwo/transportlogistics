<?php

namespace common\modules\transportlogistics\frontend\assets;

use yii\web\AssetBundle;


class CreateRequestAsset extends AssetBundle
{

    public $publishOptions = [
        'forceCopy' => true
    ];

    public $sourcePath = '@common/modules/transportlogistics/frontend/web';

    public $css = [
        'css/autocomplete.css',
    ];
    public $js = [
        'js/calendar.js',
        'js/core_autocomplete.js',
        'js/create_request.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}