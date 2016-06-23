<?php

namespace app\controllers;
use yii\caching\MemCache;
class MenuController extends CoController
{
	 public $enableCsrfValidation = false;
    public function actionAdd(){
        return $this->renderPartial("add");
    }

    public function actionList(){
        return $this->renderPartial('list');
    }
	//接受json菜单字符串，请求微信服务器接口
	public function actionAddll(){
		//接受前台的json串
		$json=$_POST['json'];
		//获取到当前操作的公众号的主键ID            
												/*
												 $memcache = new MemCache;
												$memcache->set('123','234');
												echo $memcache->get('123');
												*/
		
		$connection = \Yii::$app->db;
		$command = $connection->createCommand('SELECT p_id FROM we_public WHERE p_state=1');
		$post = $command->queryOne();
		$pid=$post['p_id'];
		//如果这个post查不出来，说明用户根本第一次使用，没有添加公众号，停止操作
		if(!$post){
			echo 1;
			exit;
		}
		//去memcache查出这个公众号所属的access_token
		$memcache = new MemCache;
		//得到access_token
		$access_token=$memcache->get($pid);
		if($access_token==''){
			$command = $connection->createCommand('SELECT p_AppID,p_AppSecret FROM we_public WHERE p_state=1');
			//获取到用户正在操作中的p_AppID,p_AppSecret
			$post = $command->queryOne();
			//通过p_AppID,p_AppSecret去获取access_token
			$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$post[p_AppID]&secret=$post[p_AppSecret]";
			//我们的$arr是一个json字符串
			$json=file_get_contents($url);
			//我们将json字符串转换成数组
			$arr=json_decode($json,true)['access_token'];
			//echo $arr['access_token'];die;
			//如果这个数组中不是我们想要的数据，说明这个返回失败，接口调用失败，这里其实可以做的更加详细一点，不过为了省事，先简单的做
			if($arr==''){
				echo 2;
				exit;
			}
				$memcache->set($pid,$arr);
				$access_token=$memcache->get($pid);
		}
		//这个url是设置菜单的微信url
		$url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
		$data=$json;
		$ch = curl_init();   //1.初始化    
		curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址    
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'post');//3.请求方式    
		//4.参数如下    
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https    
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);       
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);    
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data);           
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
		$tmpInfo = curl_exec($ch);//6.执行        
		curl_close($ch);//8.关闭    
		var_dump($tmpInfo);  
	}
}
