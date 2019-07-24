<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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

<div class="nav">
	<div class="left">发布指令日志</div>
</div>
<div class="table_list">
<table width="100%">
	<thead>
		<tr height="30">
			<td><label class="checkbox"><input type="checkbox" id="SelectAll"  value="全选" onclick="selectAll();"/></label></td>
			<td>指令</td>
			<td>状态</td>
			<td>发布</td>
			<td>删除</td>
			<td>操作</td>
		</tr>
	</thead>
	<tbody>
	<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr height="30">
			<td><input type="checkbox" name="id" value="<?php echo ($val["id"]); ?>"/></td>
			<td><?php echo (getOrderType($val["type"])); ?></td>
			<td><?php echo (getAuditStatus($val["status"])); ?></td>
			<td><?php echo (date('Y-m-d H:i',$val["sub_time"])); ?></td>
			<td><?php echo (getUpdateTime($val["del"])); ?></td>
			<td>
				<a href="<?php echo U('Order/see',"id=$val[id]");?>">查看</a> | 
				<a href="javascript:" onclick="return mydelete('<?php echo U('Order/delete_true',"id=$val[id]");?>');">彻底删除</a>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="8" class="pages"><?php echo ($pages); ?></td>
		</tr>
	</tfoot>
</table>
</div>