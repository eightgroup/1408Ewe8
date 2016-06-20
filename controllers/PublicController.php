<?php
namespace app\controllers;
use Yii;
use yii\data\Pagination;
use app\models\WePublic ;
class PublicController extends CoController
{
    public $enableCsrfValidation = false;
    public function actionAdd(){
            return $this->renderPartial("add");
    }

	//
    public function actionAddall(){
        header('content-type:text/html;charset=utf8');
       /*
            Array
        (
            [publicname] => 对对对
            [publicid] => 啊啊啊
            [publicselect] => 顶顶顶顶顶
        )
        */
        $session = \Yii::$app->session;
        $session->open();
        $id=$session->get('id');

		//接值
        $publicName = \Yii::$app->request->post('publicName');
        $publicId = \Yii::$app->request->post('publicId');
        $publicSelect = \Yii::$app->request->post('publicSelect');
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT p_id FROM we_public WHERE p_name='$publicName'");
        $post = $command->queryOne();
        if($post){
            return $this->redirect(['public/add']);
        }
        //生成tokey
        $tokey=$this->actionTokey();
        //生成url参数值
        $urlget=$this->actionUget();//生成st
        //生成微信通信页面
        $url=URL.'/web/wei/url?st='.$urlget;
        $connection->createCommand()->update('we_public', ['p_state' => 0], "p_state = 1 and u_id=$id")->execute();
        $state=$connection->createCommand()->insert('we_public', [
            'p_name' => $publicName,
            'p_type'=>'微信公众号',
            'p_AppID' =>$publicId,
            'p_AppSecret'=>$publicSelect,
            'u_id'=>$id,
            'p_state'=>1,
            'p_token'=>$tokey,
            'p_url'=> $url,
            'p_urlget'=> $urlget
        ])->execute();
        if($state){
            $this->redirect(array('/public/addselect','id'=>\Yii::$app->db->getLastInsertID()));
        }
    }
    //生成随机tokey
    protected function actionTokey($pw_length=8){
        $randpwd = '';
        for ($i = 0; $i < $pw_length; $i++)
        {
            $randpwd .= chr(mt_rand(33, 126));
        }
        return $randpwd;
    }
    //公众号列表
    public function actionList(){
        $session = \Yii::$app->session;
        $session->open();
        $id=$session->get('id');
        $query = WePublic::find();

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->where("u_id=$id")->count(),
        ]);

        $countries = $query->where("u_id=$id")
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->renderPartial('list', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
    //生成URl随机给值
    public function actionUget($len=50, $chars=null){
        if (is_null($chars)){
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        }
        mt_srand(10000000*(double)microtime());
        for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
            $str .= $chars[mt_rand(0, $lc)];
        }
        return $str;
    }

	//添加后查询展示
    public function actionAddselect(){
        $id =\Yii::$app->request->get('id');
        if($id==''){
            return false;
        }
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT * FROM we_public WHERE p_id=$id");
        $post = $command->queryOne();
        if(!$post){
            return false;
        }
        return $this->renderPartial("addselect",array('list'=>$post));
    }

    function  actionSel(){
        $id=\Yii::$app->request->post('id');
         if($id==''){
            return false;
        }
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT * FROM we_public WHERE p_id=$id");
        $post = $command->queryOne();
        if(!$post){
            return false;
        }
        echo json_encode($post);
    }

	//删除公众号
	public function actionDel(){
		$request=Yii::$app->request;
		$id=$request->get('id');
		$re=Yii::$app->db->createCommand()->delete('we_public',"p_id=:id",[':id'=> $id])->execute();
		if($re){
			return true;
		}else{
			return false;
		}
	}

	public function actionNew(){
		echo "当前公众号";
	}
}
