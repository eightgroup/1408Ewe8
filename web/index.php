<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
/*
 * 定义项目路劲
 */
$url=substr($_SERVER['SCRIPT_NAME'],0,strpos($_SERVER['SCRIPT_NAME'],'/web/'));
$url='http://'.$_SERVER['SERVER_NAME'].$url;
defined('URL') or define('URL', $url);
$url= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'/';
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
