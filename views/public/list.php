<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>微e管理系统</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script>
            var a="<?php echo URL?>/web/js/witch"
            var b="<?php echo URL?>/web/js/public"
            var c="<?php echo URL?>/web/js/current"
            var d="<?php echo URL?>/web/js/user"
        </script>
        <script src="<?php echo URL?>/web/js/jq.js"></script>
        <script src="<?php echo URL?>/web/js/user.js"></script>
		<!-- basic styles -->

		<link href="<?php echo URL?>/views/assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo URL?>/views/assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="<?php echo URL?>/views/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- fonts -->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!-- ace styles -->

		<link rel="stylesheet" href="<?php echo URL?>/views/assets/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo URL?>/views/assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="<?php echo URL?>/views/assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo URL?>/views/assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<script src="<?php echo URL?>/views/assets/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="<?php echo URL?>/views/assets/js/html5shiv.js"></script>
		<script src="<?php echo URL?>/views/assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<?php
			include('header.php');
		?>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				<?php
					include('main.php');
				?>

				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo URL?>/web/login/login">控制台</a>
							</li>

							<li>
								<a href="#">公众号管理</a>
							</li>
							<li class="active">我的公众号</li>
						</ul><!-- .breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- #nav-search -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								公众号管理
								<small>
									<i class="icon-double-angle-right"></i>
								我的公众号
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							<div class="table-responsive">
							<!-- 表单 -->
							<table id="sample-table-1" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th class="center">
											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</th>
										<th>公众号名称</th>

										<th>公众号类型</th>

										<th class="hidden-480">AppId</th>

										<th>
											<!-- <i class="icon-time bigger-110 hidden-480"></i> -->
											AppSelect
										</th>

										<th class="hidden-480">Url</th>

										<th></th>
									</tr>
								</thead>

								<tbody>
                                <?php foreach ($countries as $val): ?>
									<tr >
										<td class="center">
											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</td>

										<td>
											<a href="#"><?php echo $val['p_name']?></a>
										</td>
										<td><?php echo $val['p_type']?></td>
										<td class="hidden-480"><?php echo $val['p_AppID']?></td>
										<td><?php echo $val['p_AppSecret']?></td>

										<td class="hidden-480">
											<span class="label label-sm label-warning"><?php echo substr($val['p_url'],0,15)."....."?></span>
										</td>

										<td>
											<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
												<!-- 查询 -->
												<button class="btn btn-xs btn-success" name="sel" value="<?php echo $val['p_id']?>">
													<i class="icon-ok bigger-120" ></i>
												</button>
												<!-- 修改 -->
												<button class="btn btn-xs btn-info">
													<i class="icon-edit bigger-120" ids="update"></i>
												</button>

												<!-- 删除 -->
												<button class="btn btn-xs btn-danger" onclick="del(<?php echo $val['p_id']?>)" id="<?php echo $val['p_id']?>">
													<i class="icon-trash bigger-120" ids="del"></i>
												</button>
											</div>
										</td>
									</tr>
                                <?php endforeach; ?>
								</tbody>
							</table>
                                <?= LinkPager::widget(['pagination' => $pagination]) ?>
							<!-- 表格结束-->
							</div><!-- /.table-responsive -->
							</div><!-- /span -->
						</div><!-- /row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->

				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>

					<div class="ace-settings-box" id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
									<option data-skin="default" value="#438EB9">#438EB9</option>
									<option data-skin="skin-1" value="#222A2D">#222A2D</option>
									<option data-skin="skin-2" value="#C6487E">#C6487E</option>
									<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
								</select>
							</div>
							<span>&nbsp; Choose Skin</span>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
							<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
							<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
							<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
							<label class="lbl" for="ace-settings-add-container">
								Inside
								<b>.container</b>
							</label>
						</div>
					</div>
				</div><!-- /#ace-settings-container -->
			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> -->

		<!-- <![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo URL?>/views/assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo URL?>/web/assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo URL?>/views/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo URL?>/views/assets/js/bootstrap.min.js"></script>
		<script src="<?php echo URL?>/views/assets/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->

		<script src="<?php echo URL?>/views/assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo URL?>/views/assets/js/jquery.dataTables.bootstrap.js"></script>

		<!-- ace scripts -->

		<script src="<?php echo URL?>/views/assets/js/ace-elements.min.js"></script>
		<script src="<?php echo URL?>/views/assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->

		<script type="text/javascript">
			jQuery(function($) {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, null,null, null, null,
				  { "bSortable": false }
				] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			})
		</script>
		<script>
				$(function(){
					$("button[name=sel]").click(function(){
						var tbody=$("tbody");
						var id=$(this).val();
						$.ajax({
							type:'post',
							url:"<?php echo URL?>/web/public/sel",
							data:{
								id:id
							},
							dataType:'json',
							success:function(msg){
								var str='';
									if(msg)	{
										var str=''
										str+="<table id='table2'  border=1 class='table table-striped table-bordered table-hover'>";
										str+="<tr>";
											str+="<td>公众号名称</td>";
											str+="<td>"+msg.p_name+"</td>";
										str+="</tr>";
										str+="<tr>";
											str+="<td>公众号类型</td>"
											str+="<td>"+msg.p_type+"</td>";
										str+="</tr>";
										str+="<tr>";
											str+="<td>AppId</td>"
											str+="<td>"+msg.p_AppID+"</td>";
										str+="</tr>";
										str+="<tr>";
											str+="<td>AppSelect</td>"
											str+="<td>"+msg.p_AppSecret+"</td>";
										str+="</tr>";
										str+="<tr>";
											str+="<td>Url</td>"
											str+="<td>"+msg.p_url+"</td>";
										str+="</tr>";
										str+="<tr>";
											str+="<td>Token</td>"
											str+="<td>"+msg.p_token+"</td>";
										str+="</tr>";
												
										str+="</table>";
										// alert(str)
									$('#table2').remove();
									$('table').after(str)
									}	
							
								}

						})
						
					})


				})

			function del(id){
				var obj=document.getElementById(id);
				var sss="<?php echo URL ?>/web/public/del?id"

				$.get(sss+'='+id, function(data){
					  if(data){
						  obj.parentNode.parentNode.parentNode.parentNode.removeChild(obj.parentNode.parentNode.parentNode);
					  }else{
						  alert('出错啦!');
					  }
				});
			}
		</script>
	<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>
