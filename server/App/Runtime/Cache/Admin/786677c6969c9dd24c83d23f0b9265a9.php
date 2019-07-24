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

<form action="" method="POST">
<div class="table_full">
<table width='100%'>
	<tr>
		<th width="20%" >名称:</th>
		<td width="80%"><input  name="name"  class="input" size="20" value="<?php echo ($val["name"]); ?>" /></td>
		</td>
	</tr>
	<tr>
		<th width="20%">类型</th>
		<td width="80%"><?php echo (mySelect('DEVICE_TYPE',$val["type"])); ?></td>
	</tr>
	
	<tr style="display:<?php echo ($hidden); ?>" >
		<th width="20%">IP地址1：</th>
		<td width="80%"><input  name="addr1"  class="input" size="20" value="<?php echo ($val["addr1"]); ?>" /></td>
	</tr>
	<tr style="display:<?php echo ($hidden); ?>">
		<th width="20%">IP地址2：</th>
		<td width="80%"><input  name="addr2"  class="input" size="20" value="<?php echo ($val["addr2"]); ?>" /></td>
	</tr>
	<tr style="display:<?php echo ($hidden); ?>">
		<th width="20%">MAC：</th>
		<td width="80%" ><input  name="mac"  class="input" size="20" value="<?php echo ($val["mac"]); ?>" /></td>
		
	</tr>
	
</table>
</div>
<div class="btn_wrap">
  <div class="btn_wrap_pd">
    <input name="id" type="hidden" value="<?php echo ($id); ?>">
    <button class="btn btn_submit mr10 " type="submit">提交</button>
	<button class="btn btn-info " onclick="return window.history.go(-1)">返回</button>
  </div>
</div>
</form>


</body>
</html>