<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<link rel="stylesheet" href="/interactive/OPIS_SERVER/Public/Program/css/bootstrap.min.css" >
<link rel="stylesheet" href="/interactive/OPIS_SERVER/Public/Program/css/largeDisplay.css">
<link rel="stylesheet" href="/interactive/OPIS_SERVER/Public/Program/css/jquery-ui.min.css">

<script src="/interactive/OPIS_SERVER/Public/Program/js/jquery.min.js"></script>
<script src="/interactive/OPIS_SERVER/Public/Program/js/bootstrap.min.js"></script>
<script src="/interactive/OPIS_SERVER/Public/Program/js/largeDisplay.js"></script>
<script src="/interactive/OPIS_SERVER/Public/Program/js/jquery-ui.min.js"></script>
</head>
<body>
<?php if($Think.ACTION_NAME == 'account'){ ?>
<div class="nav">
	<div class="left">账号列表</div>
	<div class="right"><a href="<?php echo U('acc_add');?>" class="button">增加账号</a></div>
</div>
<?php }elseif($Think.ACTION_NAME == 'node'){ ?>
<div class="nav">
	<div class="left">节点列表</div>
	<div class="right"><a href="<?php echo U('node_add');?>"class="button">增加节点</a></div>
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


<h4 class="panel-title display-inline">发布名称: <?php echo ($ldName); ?></h4>
<h4 class="panel-title display-inline">播放日期: <?php echo ($date_start); ?>~<?php echo ($date_end); ?></h4>
<h4 class="panel-title display-inline">间隔时间: <?php echo ($interval); ?>秒</h4>
<h4 class="panel-title display-inline">发布时间: <?php echo ($submit_time); ?></h4>


<block name="work-space-body">
<div class="table-responsive">
	<table
		class="table table-striped table-bordered table-hover text-center">
		<thead>
			<tr>
				<th class="text-center">序号</th>
				<th class="text-center">文件名</th>
				<th class="text-center">图片</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($imgList)): $index = 0; $__LIST__ = $imgList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mp): $mod = ($index % 2 );++$index;?><tr>
				<td><?php echo ($index); ?></td>
				<td><?php echo ($mp["item_name"]); ?></td>
				<td><a target="_blank" href="<?php echo ($mp["img"]); ?>"><img src="<?php echo ($mp["img"]); ?>" height="100" width="100"/></a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
</div>
<!--table end-->