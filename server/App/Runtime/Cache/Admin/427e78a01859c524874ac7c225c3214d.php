<?php if (!defined('THINK_PATH')) exit();?><link href="/lms/server/Public/Program/css/bootstrap.min.css" rel="stylesheet">
<script src="/lms/server/Public/Program/js/jquery.min.js"></script>
<script src="/lms/server/Public/Program/js/largeDisplay_imgList.js"></script>
<table class="table table-hover text-center">
	<tbody>
		<?php if(is_array($mpList)): $i = 0; $__LIST__ = $mpList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mp): $mod = ($i % 2 );++$i;?><tr>
			<td><input type="checkbox" class="imgid" value="<?php echo ($mp["id"]); ?>"
				data-name="<?php echo ($mp["file_name"]); ?>"
				data-src="" 
				data-url=""
				/>
			</td>
			<td><?php echo ($mp["file_name"]); ?></td>
			<td>
				<a target="_blank" href="/lms/server/Public/upload/<?php echo ($mp["temp_name"]); ?>">查看</a>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<tr>
			<td colspan="3">
				<div class="page"><?php echo ($page); ?></div>
			</td>
		</tr>
	</tbody>
</table>