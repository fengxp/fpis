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

<link rel="StyleSheet" href="/interactive/OPIS_SERVER/Public/dtree/dtree.css" type="text/css" />
<script type="text/javascript" src="/interactive/OPIS_SERVER/Public/dtree/dtree.js"></script>
<div class="nav">
	<div class="left">查看发布指令</div>
	<div class="right"><a href="#" class="button" onclick="window.history.go(-1)">返回</a></div>
</div>
<div class="table_full">
<table width='100%'>
	
		<th width="20%">指令</th>
		<td width="80%"><?php echo (getOrderType($val["type"])); ?></td>
	</tr>
	<tr>
		<th width="20%">状态</th>
		<td width="80%"><?php echo (getAuditStatus($val["status"])); ?></td>
	</tr>
	<tr>
		<th width="20%" >发布时间:</th>
		<td width="80%"><?php echo (date('Y-m-d H:i',$val["sub_time"])); ?></td>
		</td>
	</tr>
	<tr>
		<th width="20%">所选设备</th>
		<td width="80%" >
			<p><a href="javascript: d.openAll();">展开</a> | <a href="javascript: d.closeAll();">合并</a>
			</p>
			<br>
			<div id="myTree"></div>
		</td>
		
	</tr>
	
</table>

</div>
<div class="btn_wrap">
  <div class="btn_wrap_pd">
 
	<button type="button" class="btn btn-info" onclick="return window.history.go(-1)">返回</button>
  </div>
</div>
<script type="text/javascript">
	var dtroot="/interactive/OPIS_SERVER/Public/dtree";
	d = new dTree('d');
	d.config.check = true;
	$.ajax({  
                url : "<?php echo U('getDevice');?>",  
                async : false,//同步，等这个请求完成后才继续往下执行,这样myTree才能使用返回来的数据  
                dataType: "json",  
                success: function(myData) { 
                    for ( var i = 0; i < myData.length; i++) {  
                        var obj = myData[i];
                        //right是window.parent的一个frame的name  
                        d.add(obj.id, obj.p_id, obj.name,"","",""); 
						
                    }
					document.getElementById('myTree').innerHTML=d;
					d.defaultChecked("<?php echo ($val["device"]); ?>");
                }  
          }); 
          d.config.useCookies = false;
          d.config.inOrder = true;
</script>