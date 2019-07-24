<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=">
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

<!-- <form action="" method="post"> -->

<div class="table_full">
<table width='100%'>
	<tr>
		<th width="20%" >名称:</th>
		<td width="80%"><?php echo ($val["name"]); ?></td>
		</td>
	</tr>
	<tr>
		<th width="20%">类型</th>
		<td width="80%"><?php echo (getDeviceType($val["type"])); ?></td>
	</tr>
	<tr>
		<th width="20%">提交时间：</th>
		<td width="80%"><?php echo (date('Y-m-d H:i',$val["sub_time"])); ?> </td>
	</tr>
	<tr style="display:<?php echo ($hidden); ?>" >
		<th width="20%">IP地址1：</th>
		<td width="80%"><?php echo ($val["addr1"]); ?></td>
	</tr>
	<tr style="display:<?php echo ($hidden); ?>">
		<th width="20%">IP地址2：</th>
		<td width="80%"><?php echo ($val["addr2"]); ?></td>
	</tr>
	<tr style="display:<?php echo ($hidden); ?>">
		<th width="20%">MAC：</th>
		<td width="80%" ><?php echo ($val["mac"]); ?></td>
		
	</tr>
	
</table>

</div>
<div class="right">
	<a style="display:<?php echo ($display); ?>" href="<?php echo U('device_add',"id=$val[id]");?>"class="button">增加</a>
	<a href="<?php echo U('device_edit',array('id'=>$val[id],type=>$val[type]));?>"class="button">修改</a>
	<a href="<?php echo U('device_del',array('id'=>$val[id],type=>$val[type]));?>"class="button">删除</a>
</div>