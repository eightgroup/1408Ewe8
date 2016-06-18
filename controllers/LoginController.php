<?php
namespace app\controllers;
use Yii;
//核心控制器
class LoginController extends \yii\web\Controller
{
    public $layout='';
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $session = \Yii::$app->session;
        $session->open();
        $name = $session->get('name')?$session->get('name'):'';
        $pwd = $session->get('pwd')?$session->get('pwd'):'';
		//echo $name.$pwd;die;
        if($name && $pwd){
			return $this->renderPartial('login',['name'=>$name,'pwd'=>$pwd]);
        }else{
            return $this->renderPartial('login');
        }
    }
    //展示登录页面,并展示当前
    public function actionLogin(){
        //开启session
        $session = \Yii::$app->session;
        $session->open();
        if($session->get('id')==''){
            echo "<script>alert('请先登录');location.href='index.php?r=login/index'</script>";
        }else{
            //视图
			$arr=Yii::$app->db->createCommand('select * from we_public where p_state=1');
			$arr=$arr->queryAll();
			//var_dump($arr);die;
            return $this->renderPartial('index',['arr'=>$arr]);
        }
    }
    public function actionForget(){
        echo "忘记密码";die;
    }

	//注册
    public function actionRegister(){
        $request=Yii::$app->request;
        $u_name=$request->post('u_name');
        $u_pwd=$request->post('u_pwd');
        $u_email=$request->post('u_email');
        $re=Yii::$app->db->createCommand()->insert('we_user',['u_name'=>"$u_name",'u_pwd'=>"$u_pwd",'u_email'=>"$u_email"])->execute();
        if($re){
            return $this->redirectPartial(['computer/index']);
        }else{
            return $this->redirectPartial(['computer/register']);
        }
    }
    /*用于登录验证*/
    public function actionProving(){
        $username = \Yii::$app->request->post('username');
        $pwd = \Yii::$app->request->post('pwd');
        $remember = \Yii::$app->request->post('remember');
		//echo $remember;die;
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT * FROM we_user WHERE u_name='$username' and u_pwd='$pwd' limit 1");
        $titles = $command->queryAll();
        if($titles){
            $session = \Yii::$app->session;
            $session->open();
            $session->set('id', $titles[0]['u_id']);
            $session->set('name', $titles[0]['u_name']);
			if($remember){
                $session->set('pwd', $titles[0]['u_pwd']);
                echo true;
            }
			echo true;
        }else{
            echo false;
        }
    }
	
	//退出
	public function actionExit(){
		$session=Yii::$app->session;
		unset ($session['name']);
		unset ($session['pwd']);
		Yii::$app->getSession()->setFlash('success','退出成功');
		return $this->redirect(['login/index']);
	}
}
