<?php

namespace xj\rbac;

use yii\web\AssetBundle;

class RbacAsset extends AssetBundle {

    public $sourcePath;
    public $basePath = '@webroot/assets';
    public $publishOptions = ['forceCopy' => YII_DEBUG];
    public $css = [
        'css/rbac.css',
    ];
    public $js = [
        'js/rbac.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

    public function init() {
        $this->sourcePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets';
        return parent::init();
    }

}
