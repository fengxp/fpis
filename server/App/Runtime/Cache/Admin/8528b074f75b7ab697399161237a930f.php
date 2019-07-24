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
		<th width="20%">角色名称：</th>
		<td width="80%"><input type="text" name="role_name" class="input" size="40" value="" /></td>
	</tr>

	<tr>
		<th width="20%">角色权限：</th>
		<td width="80%"> 请选择：</td>
	</tr>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
		<th width="20%"><input type="checkbox" name="p[<?php echo ($data["id"]); ?>]" value="<?php echo ($data["id"]); ?>" > <?php echo ($data["title"]); ?></th>
		<td width="80%" id="e<?php echo ($data["id"]); ?>">
		<?php if(is_array($data['child'])): $i = 0; $__LIST__ = $data['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><input type="checkbox" name="group[<?php echo ($v["id"]); ?>]" value="<?php echo ($v["id"]); ?>" /> <?php echo ($v["title"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
		</td>
	</tr>
    <script language="javascript">
        $("input[name='p[<?php echo ($data["id"]); ?>]']").click(function(){
            if($(this).prop("checked") == true){
                $("#e<?php echo ($data["id"]); ?> > input").each(function(){
                    //$(this).attr("checked", true);
					this.checked=true;
                });
            }else{
                $("#e<?php echo ($data["id"]); ?> > input").each(function(){
                    //$(this).attr("checked", false);
					this.checked=false;
                });
            }
        });
    </script><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</div>
<div class="btn_wrap">
  <div class="btn_wrap_pd">
    <input name="role_id" type="hidden" value="0">
    <button class="btn btn_submit mr10 " type="submit">提交</button>
	<a href="#" class="button" onclick="window.history.go(-1)">返回</a>
  </div>
</div>
</form>
</body>
</html>