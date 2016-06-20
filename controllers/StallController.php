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
        return $this->renderPartial('stall1');
    }
    public function actionInstall2(){
        return $this->renderPartial('stall2');
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