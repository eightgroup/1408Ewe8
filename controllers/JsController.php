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

	//查询公众号
    public function actionPublic(){
        $session = \Yii::$app->session;
        $session->open();
        $id=$session->get('id');;
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT * FROM we_public WHERE u_id=$id and p_state!=1");
        $lists = $command->queryAll();
        $str='';
        if($lists){
            foreach($lists as $key=>$val){
                $str.="<li ><a href='#' onclick='witch(".$val['p_id'].")'><i class='icon-cog'></i>".$val['p_name']."</a></li>";
            }
            $str.="<li style='display: none'><a href='#' ><i class='icon-cog'></i></a></li>";
        }
        echo $str;
    }

	//公众号切换
    public function actionCurrent(){
        $session = \Yii::$app->session;
        $session->open();
        $id=$session->get('id');
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT p_name FROM we_public WHERE u_id=$id and p_state=1");
        $lists = $command->queryOne();
        if(!$lists){
            $str='<small>您暂时没有操作的</small>
            公众号';
        }else{
            $str='<small>您当前操作的是,</small>
                 '.$lists['p_name'];
        }
        echo $str;
    }

	//修改切换后的数据库状态
    public function actionWitch(){
        $id = \Yii::$app->request->post('id');
        $session = \Yii::$app->session;
        $session->open();
        $sessionId=$session->get('id');
        $connection = \Yii::$app->db;
        $connection->createCommand()->update('we_public', ['p_state' => 0], "p_state = 1 and u_id=$sessionId")->execute();
        $connection->createCommand()->update('we_public', ['p_state' => 1], "p_id=$id")->execute();
        $command = $connection->createCommand("select p_name from we_public where p_id=$id");
        $post = $command->queryOne();
        echo $post['p_name'];
    }
}