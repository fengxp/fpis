<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="width=device-width, IE=edge, chrome=">
<link href="/lms/server/Public/Admin/css/reset.css" rel="stylesheet" type="text/css" />
<link href="/lms/server/Public/Admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/lms/server/Public/Admin/css/admin_style.css" rel="stylesheet" type="text/css" />

<script  src="/lms/server/Public/Admin/js/jquery.js"></script>
<script  src="/lms/server/Public/Admin/js/bootstrap.min.js"></script>
<script  src="/lms/server/Public/Common/Layer-1.9.3/layer.js"></script>
<script  src="/lms/server/Public/Admin/js/admin.js"></script>
<title></title>
</head>
<body  class="wrap J_check_wrap">
<?php if($Think.ACTION_NAME == 'account'){ ?>
<div class="nav">
	<div class="left">账号列表</div>
	<div class="right"><a href="<?php echo U('acc_add');?>" class="button">增加账号</a></div>
</div>
<?php }elseif($Think.ACTION_NAME == 'node'){ ?>
<div class="nav">
	<div class="left">节点列表</div>
	<div class="right">
		<a href="<?php echo U('node_add');?>"class="button">增加节点</a>&nbsp;&nbsp;
		<a href="#" class="button" onclick="window.history.go(-1)">返回</a>
	</div>
</div>
<?php }elseif($Think.ACTION_NAME == 'group'){ ?>
<div class="nav">
	<div class="left">权限组管理</div>
	<div class="right"><a href="<?php echo U('group_add');?>" class="button">增加权限组</a></div>
	</div>
<?php }elseif($Think.ACTION_NAME == 'acc_add'){ ?>
<div class="nav">
	<div class="left">增加账号</div>
	<div class="right"><a href="#" class="button" onclick="window.history.go(-1)">返回</a></div>
</div>
<?php }elseif($Think.ACTION_NAME == 'acc_edit'){ ?>
<div class="nav">
	<div class="left">修改账号</div>
	<div class="right"><a href="#" class="button" onclick="window.history.go(-1)">返回</a></div>
</div>
<?php } ?>

<style> 
#wrap{    
       clear:both;       
       margin:0 auto;   
}   
#left_a { float:left;width:"100%";}   
#right_a { float:right;width:"100%";}  
</style>
<div class="nav">
	<div class="left">发布节目</div>
</div>
<form action="" method="post" onsubmit="return check();" >
<div id="wrap">
	<div id="left_a">
		<iframe id="left" name="left" frameborder="0" scrolling="yes" width="400px" height="500px" src="<?php echo U('device');?>"></iframe>
	</div>		
	<div id="right_a">	
		<iframe id="right" name="right" frameborder="0" scrolling="yes" width="560px" height="480px" src="<?php echo U('proLists');?>"></iframe>
	</div>		
</div>
<input name="device" id="device" type="hidden" value="">
<input name="program" id="program" type="hidden" value="">
<div class="btn_wrap">
  <div class="btn_wrap_pd">
	<button class="btn btn_submit mr10 " type="submit">提交</button>
	<a href="#" class="button" onclick="window.history.go(-1)">返回</a>
  </div>
</div>
</form>
</body>
</html>
<script>
	function check(){
		right.window.check_radio();
		var device = left.window.d.getText();
		var program = window.document.getElementById("program").value;
		if(device == '')
		{
			alert("请选择设备")
			return false;
		}else
		{
			window.document.getElementById("device").value=device;
		}
		if(program == '')
		{
			alert("请选择节目单")
			return false;
		}
		return true;
	}
</script>