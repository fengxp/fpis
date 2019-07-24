<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="/lms/server/Public/uploadify/jquery.min.js" type="text/javascript"></script>
<script src="/lms/server/Public/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/lms/server/Public/uploadify/uploadify.css">
<link href="/lms/server/Public/Admin/css/admin_style.css" rel="stylesheet" type="text/css" />

</head>

<body>
	<br>
	<form>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
		<div id="image" class="image"></div>
		<input type="hidden" id="url" value="/lms/server/Media">
		<input type="hidden" id="root" value="/lms/server">
		<input type="hidden" id="public" value="/lms/server/Public">
	</form>
	<script type="text/javascript">
		function del(delName,delId){			//点击删除链接，ajax
			var info=$('#url').val();				//获取url
			var d='#'+delName;
			var url=info+"/del";						//删除图片的路径
			 $.post(url,{'name':delId},function(data){	//ajax后台
				alert(data.info);
				$(d).html(data.info);						//输出后台返回信息
				$(d).hide(3000);							//自动隐藏
			},'json');										//josn格式

		}

		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo ($time); ?>',            //时间
					'token'     : '<?php echo (md5($time )); ?>',		//加密字段
					'url'		: $('#url').val()+'/upload/',	//url
					'imageUrl'	: $('#root').val()				//root
				},

				'fileTypeDesc' : '',					//类型描述
				'removeCompleted' : false,    //是否自动消失
        		'fileTypeExts' : '*.gif; *.jpg; *.png; *.mp4',		//允许类型
        		'fileSizeLimit' : '300MB',					//允许上传最大值
				'swf'      : $('#public').val()+'/uploadify/uploadify.swf',	//加载swf
				'uploader' : $('#url').val()+'/uploadify',					//上传路径
				'buttonText' :'文件上传',									//按钮的文字

				'onUploadSuccess' : function(file, data, response) {			//成功上传返回
            	var n=parseInt(Math.random()*100);								//100以内的随机数
            	//alert(n+data);
            	//插入到image标签内，显示图片的缩略图
				$('#image').append('<div id="'+n+'" class="photo"><a href="'+data+'"  target="_blank"><img src="'+data+'"  height=80 width=80 /></a><div class="del"><a href="javascript:vo(0)" onclick=del("'+n+'","'+data+'");return false;>删除</a></div></div>');
				}

			});
		});



	</script>

</body>
</html>