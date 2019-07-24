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

<form action="" method="post">
<div class="table_full">
<table width='100%'>
	<tr>
		<th width="20%">绑定节点：</th>
		<td width="80%">
			<select name="pid">
				<option value="0">作为一级节点</option>
				<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data["id"]); ?>" <?php if($data[id] == $val[pid]): ?>selected<?php endif; ?>><?php echo ($data["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</td>
	</tr>
	<tr>
		<th width="20%">节点名称（title）：</th>
		<td width="80%"><input type="text" name="title" class="input" size="40" value="<?php echo ($val["title"]); ?>" /></td>
	</tr>
	<tr>
		<th width="20%">节点方法（name）：</th>
		<td width="80%"><input type="text" name="name" class="input" size="15" value="<?php echo ($val["name"]); ?>" /></td>
	</tr>
	
	<tr>
		<th width="20%">菜单中隐藏：</th>
		<td width="80%"><input type="radio" name="status" class="input" size="40" value="0" <?php if($val["status"] == 0): ?>checked<?php endif; ?> /> 隐藏 <input type="radio" name="status" class="input" size="40" value="1" <?php if($val["status"] == 1): ?>checked<?php endif; ?> /> 显示</td>
	</tr>
</table>
</div>
<div class="btn_wrap">
  <div class="btn_wrap_pd">
    <input name="id" type="hidden" value="<?php echo ($val["id"]); ?>">
    <button class="btn btn_submit mr10 " type="submit">提交</button>
  </div>
</div>
</form>
</body>
</html>