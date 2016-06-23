<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>微e后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script>
        var a="<?php echo URL?>/web/js/witch"
        var b="<?php echo URL?>/web/js/public"
        var c="<?php echo URL?>/web/js/current"
        var d="<?php echo URL?>/web/js/user"
    </script>
    <script src="<?php echo URL?>/web/js/jq.js"></script>
    <script src="<?php echo URL?>/web/js/user.js"></script>
    <!-- 菜单添加js引入  -->
    <script type="text/javascript" src="<?php echo URL?>/views/assets/js/jquery-ui-1.10.3.min.js"></script>
    <script type="text/javascript">
        var pIndex = 1;
        var currentEntity = null;
        $(function(){
            $('tbody.mlist').sortable({handle: '.icon-move'});
            $('.smlist').sortable({handle: '.icon-move'});
            $('.mlist .hover').each(function(){
                $(this).data('do', $(this).attr('data-do'));
                $(this).data('url', $(this).attr('data-url'));
                $(this).data('forward', $(this).attr('data-forward'));
            });
            $('.mlist .hover .smlist div').each(function(){
                $(this).data('do', $(this).attr('data-do'));
                $(this).data('url', $(this).attr('data-url'));
                $(this).data('forward', $(this).attr('data-forward'));
            });
            $(':radio[name="ipt"]').click(function(){
                if(this.checked) {
                    if($(this).val() == 'url') {
                        $('#url-container').show();
                        $('#forward-container').hide();
                    } else {
                        $('#url-container').hide();
                        $('#forward-container').show();
                    }
                }
            });
            $('#dialog').modal({keyboard: false, show: false});
            $('#dialog').on('hide', saveMenuAction);
        });
        function addMenu() {
            if($('.mlist .hover').length >= 3) {
                return;
            }
            var html = '<tr class="hover">'+
                '<td>'+
                '<div>'+
                '<input type="text" class="span4" value=""> &nbsp; &nbsp; '+
                '<a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp; '+
                '<a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp; '+
                '<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a> &nbsp; '+
                '<a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" class="icon-plus-sign" title="添加菜单"></a> '+
                '</div>'+
                '<div class="smlist"></div>'+
                '</td>'+
                '</tr>';
            $('tbody.mlist').append(html);
        }
        function addSubMenu(o) {
            if(o.find('div').length >= 5) {
                return;
            }
            var html = '' +
                '<div style="margin-top:20px;padding-left:80px;background:url(\'./resource/image/bg_repno.gif\') no-repeat -245px -545px;">'+
                '<input type="text" class="span3" value=""> &nbsp; &nbsp; '+
                '<a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp; '+
                '<a href="javascript:;" onclick="setMenuAction($(this).parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp; '+
                '<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a> '+
                '</div>';
            o.append(html);
        }
        function deleteMenu(o) {
            if($(o).parent().parent().hasClass('smlist')) {
                $(o).parent().remove();
            } else {
                $(o).parent().parent().parent().remove();
            }
        }
        function setMenuAction(o) {
            if(o == null) return;
            if(o.find('.smlist div').length > 0) {
                return;
            }
            currentEntity = o;
            $('#ipt-url').val($(o).data('url'));
            $('#ipt-forward').val($(o).data('forward'));
            if($(o).data('do') != 'forward') {
                $(':radio').eq(0).attr('checked', 'checked');
            } else {
                $(':radio').eq(1).attr('checked', 'checked');
            }
            $(':radio:checked').trigger('click');
            $('#dialog').modal('show');
        }
        function saveMenuAction(e) {
            var o = currentEntity;
            var t = $(':radio:checked').val();
            t = t == 'url' ? 'url' : 'forward';
            if(o == null) return;
            $(o).data('do', t);
            $(o).data('url', $('#ipt-url').val());
            $(o).data('forward', $('#ipt-forward').val());
        }
        function saveMenu() {
            if($('.span4:text').length > 3) {
                message('不能输入超过 3 个主菜单才能保存.', '', 'error');
                return;
            }
            if($('.span4:text,.span3:text').filter(function(){ return $.trim($(this).val()) == '';}).length > 0) {
                message('存在未输入名称的菜单.', '', 'error');
                return;
            }
            if($('.span4:text').filter(function(){ return $.trim($(this).val()).length > 5;}).length > 0) {
                message('主菜单的名称长度不能超过5个字.', '', 'error');
                return;
            }
            if($('.span3:text').filter(function(){ return $.trim($(this).val()).length > 8;}).length > 0) {
                message('子菜单的名称长度不能超过8个字.', '', 'error');
                return;
            }
            var dat = '[';
            var error = false;
            $('.mlist .hover').each(function(){
                var name = $.trim($(this).find('.span4:text').val()).replace(/"/g, '\"');
                var type = $(this).data('do') != 'forward' ? 'view' : 'click';
                var url = $(this).data('url');
                if(!url) {
                    url = '';
                }
                var forward = $.trim($(this).data('forward'));
                if(!forward) {
                    forward = '';
                }
                dat += '{"name": "' + name + '"';
                if($(this).find('.smlist div').length > 0) {
                    dat += ',"sub_button": [';
                    $(this).find('.smlist div').each(function(){
                        var sName = $.trim($(this).find('.span3:text').val()).replace(/"/g, '\"');
                        var sType = $(this).data('do') != 'forward' ? 'view' : 'click';
                        var sUrl = $(this).data('url');
                        if(!sUrl) {
                            sUrl = '';
                        }
                        var sForward = $.trim($(this).data('forward'));
                        if(!sForward) {
                            sForward = '';
                        }
                        dat += '{"name": "' + sName + '"';
                        if((sType == 'click' && sForward == '') || (sType == 'view' && !sUrl)) {
                            message('子菜单项 “' + sName + '”未设置对应规则.', '', 'error');
                            error = true;
                            return false;
                        }
                        if(sType == 'click') {
                            dat += ',"type": "click","key": "' + encodeURIComponent(sForward) + '"';
                        }
                        if(sType == 'view') {
                            dat += ',"type": "view","url": "' + sUrl + '"';
                        }
                        dat += '},';
                    });
                    if(error) {
                        return false;
                    }
                    dat = dat.slice(0,-1);
                    dat += ']';
                } else {
                    if((type == 'click' && forward == '') || (type == 'view' && !url)) {
                        message('菜单 “' + name + '”不存在子菜单项, 且未设置对应规则.', '', 'error');
                        error = true;
                        return false;
                    }
                    if(type == 'click') {
                        dat += ',"type": "click","key": "' + encodeURIComponent(forward) + '"';
                    }
                    if(type == 'view') {
                        dat += ',"type": "view","url": "' + url + '"';
                    }
                }
                dat += '},';
            });
            if(error) {
                return;
            }
            dat = dat.slice(0,-1);
            dat += ']';
            alert('{"button":'+dat+"}")
            return false;
            $('#do').val(dat);
            $('#form')[0].submit();
        }
    </script>
    <!-- basic styles -->

    <link href="<?php echo URL?>/views/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo URL?>/views/assets/css/font-awesome.min.css" />

    <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo URL?>/web/assets/css/font-awesome-ie7.min.css" />
    <![endif]-->

    <!-- page specific plugin styles -->

    <link rel="stylesheet" href="<?php echo URL?>/views/assets/css/jquery-ui-1.10.3.custom.min.css" />
    <link rel="stylesheet" href="<?php echo URL?>/views/assets/css/chosen.css" />
    <link rel="stylesheet" href="<?php echo URL?>/views/assets/css/datepicker.css" />
    <link rel="stylesheet" href="<?php echo URL?>/views/assets/css/bootstrap-timepicker.css" />
    <link rel="stylesheet" href="<?php echo URL?>/views/assets/css/daterangepicker.css" />
    <link rel="stylesheet" href="<?php echo URL?>/views/assets/css/colorpicker.css" />

    <!-- fonts -->

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

    <!-- ace styles -->

    <link rel="stylesheet" href="<?php echo URL?>/views/assets/css/ace.min.css" />
    <link rel="stylesheet" href="<?php echo URL?>/views/assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="<?php echo URL?>/views/assets/css/ace-skins.min.css" />

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="<?php echo URL?>/web/assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->

    <script src="<?php echo URL?>/views/assets/js/jquery.js"></script>
	<script src="<?php echo URL?>/views/assets/js/ace-extra.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="<?php echo URL?>/views/assets/js/html5shiv.js"></script>
    <script src="<?php echo URL?>/views/assets/js/respond.min.js"></script>
    <![endif]-->
	<style type="text/css">
	.table-striped td{padding-top: 10px;padding-bottom: 10px}
	a{font-size:14px;}
	a:hover, a:active{text-decoration:none; color:red;}
	.hover td{padding-left:10px;}
</style>
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
								<a href="#">控制台</a>
							</li>
				
							<li>
								<a href="#">菜单管理</a>
							</li>
							<li class="active">菜单添加</li>
						</ul>
				
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
							</form>
						</div>
					</div>
				
					<div class="page-content">
						<div class="page-header">
							<h1>
								菜单管理
								<small>
									<i class="icon-double-angle-right"></i>
									菜单添加
								</small>
							</h1>
						</div>

                        <div class="main">
                            <div class="form form-horizontal">
                                <h4>菜单设计器 <small>编辑和设置微信公众号码, 必须是服务号才能编辑自定义菜单。</small></h4>
                                <table class="tb table-striped">
                                    <tbody class="mlist ui-sortable">
                                    <tr class="hover" data-do="forward" data-url="" data-forward="V1001_TODAY_MUSIC">
                                        <td>
                                            <div>
                                                <input type="text" class="span4" value="推荐歌曲"> &nbsp; &nbsp;
                                                <a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp;
                                                <a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp;
                                                <a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a> &nbsp;
                                                <a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" class="icon-plus-sign"></a>
                                            </div>
                                            <div class="smlist ui-sortable">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover" data-do="view" data-url="" data-forward="">
                                        <td>
                                            <div>
                                                <input type="text" class="span4" value="菜单"> &nbsp; &nbsp;
                                                <a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp;
                                                <a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp;
                                                <a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a> &nbsp;
                                                <a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" class="icon-plus-sign"></a>
                                            </div>
                                            <div class="smlist ui-sortable">
                                                <div style="margin-top:20px;padding-left:80px;background:url(&#39;./resource/image/bg_repno.gif&#39;) no-repeat -245px -545px;" data-do="view" data-url="https://www.baidu.com/" data-forward="">
                                                    <input type="text" class="span3" value="搜索"> &nbsp; &nbsp;
                                                    <a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp;
                                                    <a href="javascript:;" onclick="setMenuAction($(this).parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp;
                                                    <a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a>
                                                </div>
                                                <div style="margin-top:20px;padding-left:80px;background:url(&#39;./resource/image/bg_repno.gif&#39;) no-repeat -245px -545px;" data-do="view" data-url="http://v.qq.com/" data-forward="">
                                                    <input type="text" class="span3" value="视频"> &nbsp; &nbsp;
                                                    <a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp;
                                                    <a href="javascript:;" onclick="setMenuAction($(this).parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp;
                                                    <a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a>
                                                </div>
                                                <div style="margin-top:20px;padding-left:80px;background:url(&#39;./resource/image/bg_repno.gif&#39;) no-repeat -245px -545px;" data-do="forward" data-url="" data-forward="V1001_GOOD">
                                                    <input type="text" class="span3" value="赞一下我们"> &nbsp; &nbsp;
                                                    <a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp;
                                                    <a href="javascript:;" onclick="setMenuAction($(this).parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp;
                                                    <a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="well well-small" style="margin-top:20px;">
                                    <a href="javascript:;" onclick="addMenu();">添加菜单 <i class="icon-plus-sign" title="添加菜单"></i></a> &nbsp; &nbsp; &nbsp;  <span class="help-inline">可以使用 <i class="icon-move"></i> 进行拖动排序</span>
                                </div>

                                <h4>操作 <small>设计好菜单后再进行保存操作</small></h4>
                                <table class="tb">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <input type="button" value="保存菜单结构" class="btn btn-primary span3" onclick="saveMenu()">
                                            <span class="help-block">保存当前菜单结构至公众平台, 由于缓存可能需要在24小时内生效</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="button" value="删除" class="btn btn-primary span3" onclick="$(&#39;#do&#39;).val(&#39;remove&#39;);$(&#39;#form&#39;)[0].submit();">
                                            <div class="help-block">清除自定义菜单</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="button" value="刷新" class="btn btn-primary span3" onclick="$(&#39;#do&#39;).val(&#39;refresh&#39;);$(&#39;#form&#39;)[0].submit();">
                                            <div class="help-block">重新从公众平台获取菜单信息</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.main-content -->
			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='<?php echo URL?>/views/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo URL?>/views/assets/js/bootstrap.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/typeahead-bs2.min.js"></script>

<script src="<?php echo URL?>/views/assets/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/chosen.jquery.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/fuelux/fuelux.spinner.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/date-time/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/date-time/bootstrap-timepicker.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/date-time/moment.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/date-time/daterangepicker.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/jquery.knob.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/jquery.autosize.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/bootstrap-tag.min.js"></script>

<!-- ace scripts -->

<script src="<?php echo URL?>/views/assets/js/ace-elements.min.js"></script>
<script src="<?php echo URL?>/views/assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->

<script type="text/javascript">
    jQuery(function($) {
        $('#id-disable-check').on('click', function() {
            var inp = $('#form-input-readonly').get(0);
            if(inp.hasAttribute('disabled')) {
                inp.setAttribute('readonly' , 'true');
                inp.removeAttribute('disabled');
                inp.value="This text field is readonly!";
            }
            else {
                inp.setAttribute('disabled' , 'disabled');
                inp.removeAttribute('readonly');
                inp.value="This text field is disabled!";
            }
        });


        $(".chosen-select").chosen();
        $('#chosen-multiple-style').on('click', function(e){
            var target = $(e.target).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
            else $('#form-field-select-4').removeClass('tag-input-style');
        });


        $('[data-rel=tooltip]').tooltip({container:'body'});
        $('[data-rel=popover]').popover({container:'body'});

        $('textarea[class*=autosize]').autosize({append: "\n"});
        $('textarea.limited').inputlimiter({
            remText: '%n character%s remaining...',
            limitText: 'max allowed : %n.'
        });

        $.mask.definitions['~']='[+-]';
        $('.input-mask-date').mask('99/99/9999');
        $('.input-mask-phone').mask('(999) 999-9999');
        $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
        $(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});



        $( "#input-size-slider" ).css('width','200px').slider({
            value:1,
            range: "min",
            min: 1,
            max: 8,
            step: 1,
            slide: function( event, ui ) {
                var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
                var val = parseInt(ui.value);
                $('#form-field-4').attr('class', sizing[val]).val('.'+sizing[val]);
            }
        });

        $( "#input-span-slider" ).slider({
            value:1,
            range: "min",
            min: 1,
            max: 12,
            step: 1,
            slide: function( event, ui ) {
                var val = parseInt(ui.value);
                $('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
            }
        });


        $( "#slider-range" ).css('height','200px').slider({
            orientation: "vertical",
            range: true,
            min: 0,
            max: 100,
            values: [ 17, 67 ],
            slide: function( event, ui ) {
                var val = ui.values[$(ui.handle).index()-1]+"";

                if(! ui.handle.firstChild ) {
                    $(ui.handle).append("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>");
                }
                $(ui.handle.firstChild).show().children().eq(1).text(val);
            }
        }).find('a').on('blur', function(){
            $(this.firstChild).hide();
        });

        $( "#slider-range-max" ).slider({
            range: "max",
            min: 1,
            max: 10,
            value: 2
        });

        $( "#eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
            // read initial values from markup and remove that
            var value = parseInt( $( this ).text(), 10 );
            $( this ).empty().slider({
                value: value,
                range: "min",
                animate: true

            });
        });


        $('#id-input-file-1 , #id-input-file-2').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change',
            droppable:false,
            onchange:null,
            thumbnail:false //| true | large
            //whitelist:'gif|png|jpg|jpeg'
            //blacklist:'exe|php'
            //onchange:''
            //
        });

        $('#id-input-file-3').ace_file_input({
            style:'well',
            btn_choose:'Drop files here or click to choose',
            btn_change:null,
            no_icon:'icon-cloud-upload',
            droppable:true,
            thumbnail:'small'//large | fit
            //,icon_remove:null//set null, to hide remove/reset button
            /**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
            /**,before_remove : function() {
						return true;
					}*/
            ,
            preview_error : function(filename, error_code) {
                //name of the file that failed
                //error_code values
                //1 = 'FILE_LOAD_FAILED',
                //2 = 'IMAGE_LOAD_FAILED',
                //3 = 'THUMBNAIL_FAILED'
                //alert(error_code);
            }

        }).on('change', function(){
            //console.log($(this).data('ace_input_files'));
            //console.log($(this).data('ace_input_method'));
        });


        //dynamically change allowed formats by changing before_change callback function
        $('#id-file-format').removeAttr('checked').on('change', function() {
            var before_change
            var btn_choose
            var no_icon
            if(this.checked) {
                btn_choose = "Drop images here or click to choose";
                no_icon = "icon-picture";
                before_change = function(files, dropped) {
                    var allowed_files = [];
                    for(var i = 0 ; i < files.length; i++) {
                        var file = files[i];
                        if(typeof file === "string") {
                            //IE8 and browsers that don't support File Object
                            if(! (/\.(jpe?g|png|gif|bmp)$/i).test(file) ) return false;
                        }
                        else {
                            var type = $.trim(file.type);
                            if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif|bmp)$/i).test(type) )
                                || ( type.length == 0 && ! (/\.(jpe?g|png|gif|bmp)$/i).test(file.name) )//for android's default browser which gives an empty string for file.type
                            ) continue;//not an image so don't keep this file
                        }

                        allowed_files.push(file);
                    }
                    if(allowed_files.length == 0) return false;

                    return allowed_files;
                }
            }
            else {
                btn_choose = "Drop files here or click to choose";
                no_icon = "icon-cloud-upload";
                before_change = function(files, dropped) {
                    return files;
                }
            }
            var file_input = $('#id-input-file-3');
            file_input.ace_file_input('update_settings', {'before_change':before_change, 'btn_choose': btn_choose, 'no_icon':no_icon})
            file_input.ace_file_input('reset_input');
        });




        $('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
            .on('change', function(){
                //alert(this.value)
            });
        $('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'icon-caret-up', icon_down:'icon-caret-down'});
        $('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'icon-plus smaller-75', icon_down:'icon-minus smaller-75', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});



        $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });
        $('input[name=date-range-picker]').daterangepicker().prev().on(ace.click_event, function(){
            $(this).next().focus();
        });

        $('#timepicker1').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false
        }).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });

        $('#colorpicker1').colorpicker();
        $('#simple-colorpicker-1').ace_colorpicker();


        $(".knob").knob();


        //we could just set the data-provide="tag" of the element inside HTML, but IE8 fails!
        var tag_input = $('#form-field-tags');
        if(! ( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase())) )
        {
            tag_input.tag(
                {
                    placeholder:tag_input.attr('placeholder'),
                    //enable typeahead by specifying the source array
                    source: ace.variable_US_STATES,//defined in ace.js >> ace.enable_search_ahead
                }
            );
        }
        else {
            //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
            tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
            //$('#form-field-tags').autosize({append: "\n"});
        }




        /////////
        $('#modal-form input[type=file]').ace_file_input({
            style:'well',
            btn_choose:'Drop files here or click to choose',
            btn_change:null,
            no_icon:'icon-cloud-upload',
            droppable:true,
            thumbnail:'large'
        })

        //chosen plugin inside a modal will have a zero width because the select element is originally hidden
        //and its width cannot be determined.
        //so we set the width after modal is show
        $('#modal-form').on('shown.bs.modal', function () {
            $(this).find('.chosen-container').each(function(){
                $(this).find('a:first-child').css('width' , '210px');
                $(this).find('.chosen-drop').css('width' , '210px');
                $(this).find('.chosen-search input').css('width' , '200px');
            });
        })
        /**
         //or you can activate the chosen plugin after modal is shown
         //this way select element becomes visible with dimensions and chosen works as expected
         $('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
         */

    });
</script>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>
<script>
    function hehe(){
        $('.span4').each(function(i){
            alert($(this).val())
        });
    }

</script>
