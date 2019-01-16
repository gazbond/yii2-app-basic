<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'dist/bootstrap.css',
        'css/site.css',
        'dist/index.css',
    ];
    public $js = [
        ['dist/lib.js', 'position' => View::POS_HEAD]
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
