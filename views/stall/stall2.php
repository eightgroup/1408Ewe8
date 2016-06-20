<!DOCTYPE html>
<html lang="zh-cn"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>安装系统 - 微擎 - 公众平台自助开源引擎</title>
		<link rel="stylesheet" href="<?php echo URL?>/views/stall/stall2/bootstrap.css">
		<style>
			html,body{font-size:13px;font-family:"Microsoft YaHei UI", "微软雅黑", "宋体";}
			.pager li.previous a{margin-right:10px;}
			.header a{color:#FFF;}
			.header a:hover{color:#428bca;}
			.footer{padding:10px;}
			.footer a,.footer{color:#eee;font-size:14px;line-height:25px;}
		</style>
		<!--[if lt IE 9]>
		  <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body style="background-color:#28b0e4;">
		<div class="container">
			<div class="header" style="margin:15px auto;">
				<ul class="nav nav-pills pull-right" role="tablist">
					<li role="presentation" class="active"><a href="javascript:;">安装微擎系统</a></li>
					<li role="presentation"><a href="http://www.we7.cc/">微擎官网</a></li>
					<li role="presentation"><a href="http://bbs.we7.cc/">访问论坛</a></li>
				</ul>
				<img src="<?php echo URL?>/views/stall/stall2/install.png">
			</div>
			<div class="row well" style="margin:auto 0;">
				<div class="col-xs-3">
					<div class="progress" title="安装进度">
						<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
							75%
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							安装步骤
						</div>
						<ul class="list-group">
							<a href="javascript:;" class="list-group-item list-group-item-success"><span class="glyphicon glyphicon-copyright-mark"></span> &nbsp; 许可协议</a>
							<a href="javascript:;" class="list-group-item list-group-item-success"><span class="glyphicon glyphicon-eye-open"></span> &nbsp; 环境监测</a>
							<a href="javascript:;" class="list-group-item list-group-item-info"><span class="glyphicon glyphicon-cog"></span> &nbsp; 参数配置</a>
							<a href="javascript:;" class="list-group-item"><span class="glyphicon glyphicon-ok"></span> &nbsp; 成功</a>
						</ul>
					</div>
				</div>
				<div class="col-xs-9">
						
	<form class="form-horizontal" method="post" role="form">
		<div class="panel panel-default">
			<div class="panel-heading">安装选项</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">安装方式</label>
					<div class="col-sm-10">
						<label class="radio-inline">
							<input name="type" value="remote" type="radio"> 在线安装
						</label>
						<label class="radio-inline">
							<input name="type" value="local" checked="checked" type="radio"> 离线安装
						</label>
						<div class="help-block">
							<span style="color:red">由于在线安装是精简版，安装后，请务必注册云服务更新到完整版</span> <br>
							在线安装能够直接安装最新版本微擎系统, 如果在线安装困难, 请下载离线安装包后使用本地安装. <br>
							离线安装包可能不是最新程序, 如果你不确定, 可以现在访问官网重新下载一份最新的.
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default" id="shuju">
			<div class="panel-heading">数据库选项</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库主机</label>
					<div class="col-sm-4">
						<input class="form-control" name="db[server]" value="127.0.0.1" type="text" id='server'>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库用户</label>
					<div class="col-sm-4">
						<input class="form-control" name="db[username]" value="root" type="text" id='username'>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库密码</label>
					<div class="col-sm-4">
						<input class="form-control" name="db[password]" type="text" id='password'>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">表前缀</label>
					<div class="col-sm-4">
						<input class="form-control" name="db[prefix]" value="ims_" type="text" id="prefix">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库名称</label>
					<div class="col-sm-4">
						<input class="form-control" name="db[name]" value="we" type="text" id="dbname">
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">管理选项</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">管理员账号</label>
					<div class="col-sm-4">
						<input class="form-control" name="user[username]" type="username" id='user'>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">管理员密码</label>
					<div class="col-sm-4">
						<input class="form-control" name="user[password]" type="password" id='pwd'>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">确认密码</label>
					<div class="col-sm-4">
						<input class="form-control" type="password">
					</div>
				</div>
			</div>
		</div>
		<input name="do" id="do" type="hidden">
		<ul class="pager">
			<li class="previous"><a href="javascript:;" onclick="$('#do').val('back');$('form')[0].submit();"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a></li>
			<li class="previous"><a href="javascript:;"  class='sub'>继续 <span class="glyphicon glyphicon-chevron-right"></span></a></li>
		</ul>
	</form>
	<script>
		var lock = false;
		function check(obj) {
			if(lock) {
				return;
			}
			$('.form-control').parent().parent().removeClass('has-error');
			var error = false;
			$('.form-control').each(function(){
				if($(this).val() == '') {
					$(this).parent().parent().addClass('has-error');
					this.focus();
					error = true;
				}
			});
			if(error) {
				alert('请检查未填项');
				return false;
			}
			if($(':password').eq(0).val() != $(':password').eq(1).val()) {
				$(':password').parent().parent().addClass('has-error');
				alert('确认密码不正确.');
				return false;
			}
			lock = true;
			$(obj).parent().addClass('disabled');
			$(obj).html('正在执行安装');
			return true;
		}
	</script>
				</div>
			</div>
			<div class="footer" style="margin:15px auto;">
				<div class="text-center">
					<a href="http://www.we7.cc/">关于微e</a> &nbsp; &nbsp; <a href="http://bbs.we7.cc/">微擎帮助</a> &nbsp; &nbsp; <a href="http://www.we7.cc/">购买授权</a>
				</div>
				<div class="text-center">
					Powered by <a href="http://www.we7.cc/"><b>微e</b></a> v0.7 © 2014 <a href="http://www.we7.cc/">www.we7.cc</a>
				</div>
			</div>
		</div>
		<script src="<?php echo URL?>/views/stall/stall2//jquery.js"></script>
		<script src="<?php echo URL?>/views/stall/stall2/bootstrap.js"></script>
	
</body></html>
<script>
   $(function(){
   		$(".sub").click(function(){
   			var url="<?php echo URL ?>/web/stall/tests";
   			var server=$("#server").val();
   			var username=$("#username").val();
   			var password=$("#password").val();
   			var prefix=$("#prefix").val();
   			var dbname=$("#dbname").val();
   			var user=$("#user").val();
   			var pwd=$("#pwd").val();

   			
   			$.ajax({
				type:'post',
				url:url,
				data:{
					server:server,
					username:username,
					password:password,
					prefix:prefix,
					dbname:dbname,
					user:user,
					pwd:pwd
				},
				// 'dataType':'json',
				success:function(msg){
					if(msg==1){
						alert("正在生成");
      		 	location.href="<?php echo URL  ?>/web/stall/install3";

					}else{
						alert('数据库连接错误');
					}
				}
			})
   			
   			
   		})
   })
</script>