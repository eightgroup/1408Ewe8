<?php
namespace app\controllers;
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
        if($name && $pwd){
			return $this->renderPartial('login',['name'=>$name,'pwd'=>$pwd]);
        }else{
            return $this->renderPartial('login');
        }
    }
    //展示登录页面
    public function actionLogin(){
        $session = \Yii::$app->session;
        $session->open();
        if($session->get('id')==''){
            echo "<script>alert('请先登录');location.href='index.php?r=login/index'</script>";
        }else{
            return $this->renderPartial('index');
        }
    }
    public function actionForget(){
        echo "忘记密码";die;
    }
    public function actionRegister(){
        echo "用户注册";die;
    }
    /*用于登录验证*/
    public function actionProving(){
        $username = \Yii::$app->request->post('username');
        $pwd = \Yii::$app->request->post('pwd');
        //$remember = \Yii::$app->request->post('remember')?\Yii::$app->request->post('remember'):'';
        //var_dump($remember);die;
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT * FROM we_user WHERE u_name='$username' and u_pwd='$pwd' limit 1");
        $titles = $command->queryAll();
        if($titles){
            $session = \Yii::$app->session;
            $session->open();
            $session->set('id', $titles[0]['u_id']);
            $session->set('name', $titles[0]['u_name']);
            echo true;
        }else{
            echo false;
        }
    }
}
