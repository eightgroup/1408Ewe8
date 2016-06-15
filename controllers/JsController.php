<?php
namespace app\controllers;
//js公共控制器
class JsController extends \yii\web\Controller{
    //得到当前登录人的姓名
    public $enableCsrfValidation = false;
    public function actionUser(){
        $session = \Yii::$app->session;
        $session->open();
        return $session->get('name');
    }
    public function actionPublic(){
        $session = \Yii::$app->session;
        $session->open();
        $id=$session->get('id');;
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT * FROM we_public WHERE u_id=$id");
        $lists = $command->queryAll();
        $str='';
        if($lists){
            foreach($lists as $key=>$val){
                $str.="<li><a href='#'><i class='icon-cog'></i>".$val['p_name']."</a></li>";
            }
            $str.="<li style='display: none'><a href='#' ><i class='icon-cog'></i></a></li>";
        }else{
               $str.="<li><a href='#' ><i class='icon-cog'></i>请您添加一个公众号</a></li>";
        }
        echo $str;
    }
    public function current(){
        $session = \Yii::$app->session;
        $session->open();
        $id=$session->get('id');
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT * FROM we_public WHERE u_id=$id and p_state=1");
        $lists = $command->queryOne();
        print_r($lists);
    }
}