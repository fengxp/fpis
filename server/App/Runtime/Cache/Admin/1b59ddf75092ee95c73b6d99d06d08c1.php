<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
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

<form action="" method="post" onsubmit="return check_accadd();" >
<div class="table_full">
<table width='100%'>
	<tr>
		<th width="20%">用户名：</th>
		<td width="80%"><input type="text" id="account" name="account" class="input" size="40" value="" /></td>
	</tr>
	<tr>
		<th width="20%">EMAIL：</th>
		<td width="80%"><input type="text" id="email" name="email" class="input" size="20" value="" /></td>
	</tr>
	<tr>
		<th width="20%">电话：</th>
		<td width="80%"><input type="text" id="mobile" name="mobile" class="input" size="20" value="" /></td>
	</tr>
	<tr>
		<th width="20%">密码：</th>
		<td width="80%"><input type="password" id="password" name="password" class="input" size="20" value="" /></td>
	</tr>
	<tr>
		<th width="20%">确认密码：</th>
		<td width="80%"><input type="password" id="re_password" name="re_password" class="input" size="20" value="" /></td>
	</tr>
	<tr>
		<th width="20%">角色选择：</th>
		<td width="80%">
			<select id="role_id" name="role_id">
				<option value="0">请选择角色</option> 
				<?php if(is_array($role_list)): $i = 0; $__LIST__ = $role_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</td>
	</tr>
	
</table>
</div>
<div class="btn_wrap">
  <div class="btn_wrap_pd">
    <input id="user_id" type="hidden" value="<?php echo ($val["user_id"]); ?>">
    <button class="btn btn_submit mr10 " type="submit">提交</button>
  </div>
</div>
</form>
</body>
</html>
<script>
	function  check_accadd(){
		//alert('a');
		var role = document.getElementById("role_id").value;
		if(role ==0)
		{
			alert('请选择角色');
			return false;
		}
	}
</script>