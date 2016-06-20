<?php
namespace app\controllers;
use Yii;
use yii\db\mssql\PDO;
use yii\db\mssql\mysqli;
use yii\db\mssql\mysql;
class StallController extends \yii\web\Controller{
     public $enableCsrfValidation = false;
    public function actionInstall(){
        return $this->renderPartial('stall');
    }
    public function actionInstall1(){
        $config=$this->actionDir_writeable('../config');
        $vendor=$this->actionDir_writeable('../vendor');
        //echo $config;die;
        return $this->renderPartial('stall1',array('config'=>$config,'vendor'=>$vendor));
    }
    public function actionInstall2(){
        
        return $this->renderPartial('stall2');
    }
    public function actionDir_writeable($dir) {
        if(!is_dir($dir)) {
            @mkdir($dir, 0777);
        }
        if(is_dir($dir)) {
            if($fp = @fopen("$dir/test.txt", 'w')) {
                @fclose($fp);
                @unlink("$dir/test.txt");
                $writeable = 1;
            } else {
                $writeable = 0;
            }
        }
        return $writeable;
      }
    public function actionInstall3(){
        return $this->renderPartial('stall3');
    }

    function actionTests(){
        $server=$_POST['server'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $prefix=$_POST['prefix'];
        $dbname=$_POST['dbname'];
        $user=$_POST['user'];
        $pwd=$_POST['pwd'];


       //判断数据库连接
        
        @$link=mysql_connect("$server","$username","$password");                     
            if(!$link){
               
                echo 0;die;
  
            }else{
                echo 1;
            }
        mysql_query("create database $dbname");
        $sql=file_get_contents("we2.sql");
        mysql_select_db($dbname);
        $a=explode(";",$sql);
     
        foreach ($a as $v) {
            mysql_query($v.';');
        }
 $sql4="insert into we_user(u_id,u_name,u_pwd)values(null,'$user','$pwd')";
   $re=mysql_query($sql4);
      $fh = fopen("../vendor/install.php","w");
      $str="<?php return ['class' => 'yii\db\Connection','dsn' => 'mysql:host=$server;dbname=$dbname','username' => '$username','password' => '$password','charset' => 'utf8',];";
      file_put_contents('../config/db.php',$str);


    //     mysqli_query($link,"set name utf8");

    //     //引入sql文件并建表
    //     $sql=file_get_contents("we2.sql");
    //     $a=explode(";",$sql);
    //     // var_dump($a);
    //     foreach ($a as $v) {
    //         mysqli_query($link,$v.';');
    //     }
           
    //     //添加管理员!
    // mysqli_query($link,$sql4);
   
    }
}