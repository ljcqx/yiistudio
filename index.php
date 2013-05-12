<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
//在应用程序的开始附加一个句柄
Yii::app()->onBeginRequest = function($event)
{
    //用ob_gzhandler来开始输出缓冲
    return ob_start("ob_gzhandler");
};
//附加一个句柄到应用程序
Yii::app()->onEndRequest = function($event)
{
    //释放输出缓冲
    return ob_end_flush();
};

Yii::createWebApplication($config)->run();
