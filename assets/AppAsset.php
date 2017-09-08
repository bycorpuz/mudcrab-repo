<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Nenad Zivkovic <nenad@freetuts.org>
 * 
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    // public $basePath = '@webroot';
    //public $baseUrl = '@themes';
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $js = [
        //'datatables/jquery.dataTables.min.js',
        //'datatables/dataTables.bootstrap.min.js',
        'dataTables/datatablesnew.min.js',
        
        'pace/pace.min.js',
        'bootstrap-notify/bootstrap-notify.min.js',
        'sweetalert/dist/sweetalert.min.js',
        'jQuery/jquery.timeago.js',
        'bobszkietotx/main.min.js',

        // more plugin Js here
    ];
    public $css = [
        //'datatables/dataTables.bootstrap.css',
        'dataTables/datatables.min.css',
        'pace/pace.min.css',
        'sweetalert/dist/sweetalert.css',
        //'growl/jquery.growl.css',
        // more plugin CSS here
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}
