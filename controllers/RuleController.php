<?php

namespace app\controllers;

class RuleController extends CoController
{
    public $enableCsrfValidation = false;
    public function actionAdd(){
        return $this->renderPartial("add");
    }
    //规则入库
    public function actionAddall(){
        //接受规则类型
        $id= \Yii::$app->request->post('id');
        //接受规则名称
        $name= \Yii::$app->request->post('name');
        //规则关键字
        $guize= \Yii::$app->request->post('guize');
        //规则内容
        $content= \Yii::$app->request->post('content');
        $connection = \Yii::$app->db;
        $session = \Yii::$app->session;
        $session->open();
        $uid=$session->get('id');
        $command = $connection->createCommand("select p_id from we_public where p_state=1");
        $pid=$command->queryOne()['p_id'];
        $state=$connection->createCommand()->insert('we_rule', [
            'r_name'=>$name,
            'r_keyword'=> $guize,
            'r_type'=>$id,
            'p_id'=>$pid,
            'p_content'=>$content
        ])->execute();
    }
    public function actionList(){
        return $this->renderPartial('list');
    }

}
