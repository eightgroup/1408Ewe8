<?php
namespace app\controllers;
class CoController extends \yii\web\Controller{
    public function init(){
        //$src= \Yii::$app->request->url.'../../../1.jpg';
        parent::init();
        $session = \Yii::$app->session;
        $session->open();
        if($session->get('id')==''){
            echo "<script>alert('请先登录');location.href='index.php?r=login/index'</script>";
        }
    }
}