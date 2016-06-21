<?php

namespace app\controllers;
use Yii;
use yii\data\Pagination;
use app\models\WeRule;
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
		return "添加成功!";
    }

	//规则列表
    public function actionList(){
		$arr=Yii::$app->db->createCommand("select p_id,p_name from we_public where p_state=1");
		$arr=$arr->queryAll();
		if($arr){
			$p_id=$arr[0]['p_id'];
			$query = WeRule::find();

			$pagination = new Pagination([
				'defaultPageSize' => 3,
				'totalCount' => $query->where("p_id=$p_id")->count(),
			]);

			$countries = $query->where("p_id=$p_id")
				->offset($pagination->offset)
				->limit($pagination->limit)
				->all();

			return $this->renderPartial('list', [
				'countries' => $countries,
				'pagination' => $pagination,
			]);
		}else{
			return $this->renderPartial('listkong');
		}
		
    }

}
