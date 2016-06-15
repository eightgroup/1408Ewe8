<?php
namespace app\controllers;
class WeiController extends \yii\web\Controller{
    public $enableCsrfValidation = false;
    public function actionUrl(){
        $sel=$_GET['st'];
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT p_token FROM we_public WHERE p_urlget='$sel'");
        $post = $command->queryOne();
        $p_token=$post['p_token'];
        include_once('weixin.php');
    }
}