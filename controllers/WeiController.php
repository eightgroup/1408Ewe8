<?php
namespace app\controllers;
class WeiController extends \yii\web\Controller{
    public $enableCsrfValidation = false;
    public function actionUrl(){
        $sel=$_GET['st'];
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT p_token,p_id FROM we_public WHERE p_urlget='$sel'");
        $post = $command->queryOne();
        $p_token=$post['p_token'];
        $p_id=$post['p_id'];
        $command = $connection->createCommand("select * from we_rule where p_id=$p_id");
        $arr=$command->queryAll();
        include_once('weixin.php');
    }
}