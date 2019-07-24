<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=">
<link href="/interactive/OPIS_SERVER/Public/Admin/css/reset.css" rel="stylesheet" type="text/css" />
<link href="/interactive/OPIS_SERVER/Public/Admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/interactive/OPIS_SERVER/Public/Admin/css/admin_style.css" rel="stylesheet" type="text/css" />

<script  src="/interactive/OPIS_SERVER/Public/Admin/js/jquery.js"></script>
<script  src="/interactive/OPIS_SERVER/Public/Admin/js/bootstrap.min.js"></script>
<script  src="/interactive/OPIS_SERVER/Public/Common/Layer-1.9.3/layer.js"></script>
<script  src="/interactive/OPIS_SERVER/Public/Admin/js/admin.js"></script>
<title></title>
<script type="text/javascript">
    $(document).ready(function(){
        $("#checkAll").click(function(){
            if($(this).attr("checked") == "checked"){
                $("input[type=checkbox]").each(function(){
                    $(this).attr("checked", "checked");
                });
            }else{
                $("input[type=checkbox]").each(function(){
                    $(this).attr("checked", false);
                });
            }
        });
    });

	
</script>
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
	<div class="left">已发布</div>
	<div class="right"><a href="<?php echo U('program');?>" class="btn btn_submit mr10">新发布</a>&nbsp;&nbsp;</div>
</div>
<div class="table_list">
<table width="100%">
	<thead>
		<tr height="30">
			<td><label class="checkbox"> <input type="checkbox" /></label></td>
			<td>发布时间</td>
			<td>审核状态</td>
			<td>节目单名称</td>
			<td>操作</td>
		</tr>
	</thead>
	<tbody>
	<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr height="30">
			<td><input type="checkbox" /><?php echo ($val["pid"]); ?></td>
			<td><?php echo (date('Y-m-d H:i',$val["sub_time"])); ?></td>
			<td><?php echo ($val["status"]); ?></td>
			<td><?php echo ($val["pro_name"]); ?></td>
			<td>
				<a href="<?php echo U('proSee',"id=$val[pid]");?>">查看</a> | 
				<a href="javascript:" onclick="return mydelete('<?php echo U('proDelete',"id=$val[id]");?>');">删除</a>
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