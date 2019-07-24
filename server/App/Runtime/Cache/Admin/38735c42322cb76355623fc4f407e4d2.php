<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<link rel="stylesheet" href="/lms/server/Public/Program/css/bootstrap.min.css" >
<link rel="stylesheet" href="/lms/server/Public/Program/css/largeDisplay.css">
<link rel="stylesheet" href="/lms/server/Public/Program/css/jquery-ui.min.css">

<script src="/lms/server/Public/Program/js/jquery.min.js"></script>
<script src="/lms/server/Public/Program/js/bootstrap.min.js"></script>
<script src="/lms/server/Public/Program/js/largeDisplay.js"></script>
<script src="/lms/server/Public/Program/js/jquery-ui.min.js"></script>
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

<p>
<form action="<?php echo U('publishSave');?>" method="post">
	<div class="content-top div-width">
		<table class="div-width layout-table">
			<tr>
				<td class="">名称:
				<input type="text" class="form-control" id="txtName"
					name="txtName" value="<?php echo ($txtName); ?>" maxlength="100">
				</td>
			</tr>
			
			<tr>
				<td colspan="2">
					<table>
						<tr>
							<td> <span>选择素材列表</span>
								<div class="content-left div-height">
									<iframe id="ifrimglist" class="iframe-imglist"
										src="<?php echo U('imgList');?>"></iframe>
								</div></td>
							<td>
								<div class="div-cmdbutton text-center">
									<button type="button"
										class="btn btn-info glyphicon glyphicon-ok"
										onclick="selectAll()">&nbsp;全选</button>
									<button type="button"
										class="btn btn-info glyphicon glyphicon-remove"
										onclick="clearAll()">&nbsp;取消</button>
									<button type="button"
										class="btn btn-info glyphicon glyphicon-plus"
										onclick="addItem()">&nbsp;加入</button>
									<button type="button"
										class="btn btn-info  glyphicon glyphicon-minus"
										onclick="removeItem()">&nbsp;删除</button>
									<button type="button"
										class="btn btn-info   glyphicon glyphicon-refresh"
										onclick="clearTr()">&nbsp;清空</button>
									<button type="button"
										class="btn btn-info  glyphicon glyphicon-arrow-up"
										onclick="moveUP()">&nbsp;上移</button>
									<button type="button"
										class="btn btn-info   glyphicon glyphicon-arrow-down"
										onclick="moveDown()">&nbsp;下移</button>
									<button type="submit" class="btn btn_submit"
				onclick="return submitCheck();">&nbsp;&nbsp;&nbsp;&nbsp;发布&nbsp;&nbsp;&nbsp;&nbsp;</button>
								</div>
							</td>
							<td> <span>编排素材列表</span>
								<div class="content-right div-height">
									<table id="tabImgList" class="table table-hover">
									</table>
								</div></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<input type="hidden" name="ids" id="ids" />
		<input type="hidden" name="ids2" id="ids2" />
</form>
</block>