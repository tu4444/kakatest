<h1>Article's default layout<h1>


<?php

	JHTmlBehavior::core();

	//show($this->items);
?>	
<form id="adminForm" method="post" action="<?php echo JUri::getInstance();?>" name="adminForm">
<div class="row-fluid">
<div class="span2">
	<?php echo JHtmlSidebar::render();?>
</div>
<div class="span10">
<div class="filter-bar">
	<input type="text" name="search" value="<?php echo $this->state->get('list.search');?>">
	<button class="btn" type="submit">搜尋</button>
	<button class="btn" type="button" onclick="jQuery('.filter-bar').find('input,select').val('');Joomla.submitform();">清除</button>
	<!--
		jQuery('#adminForm').submit();
		Joomla.submitform();	//如果要用寫JHTmlBehavior::core();
	-->
	<select name="filter_state" id="filter_state" onchange="Joomla.submitform();">
		<option value="">-選擇狀態</option>
		<option value="1" <?php echo ($this->state->get('list.filter_state') === '1') ? 'selected' : ''; ?>>啟動</option>
		<option value="0" <?php echo ($this->state->get('list.filter_state') === '0') ? 'selected' : ''; ?>>關閉</option>
	</select>
</div>

<table class="table table-striped">
<tbody>
	<tr>
		<th><?php echo JHtml::_('grid.checkall'); ?></th>
		<th>ID</th>
		<th>標題</th>
		<th>狀態</th>
		<th>分類</th>
		<th>作者</th>
		<th>建立時間</th>
		<th>刪除</th>	
	</tr>
<?php	foreach($this->items as $i=>$item){?>
	<tr>
		<!--1-->
		<!--<td><?php //echo $i+1;?></td>
		<td><?php //echo '名稱'.$value;?></td>-->

		<td><?php echo JHtml::_('grid.id', $i, $item->id); ?></td>
		<td><?php echo $item->id;?></td>
		<td><!--<a href="<?php //echo JRoute::_('index.php?option=com_blog&view=article&layout=edit&id='.$item->id)?>">-->
			<a href="<?php echo JRoute::_('index.php?option=com_blog&task=article.edit&id='.$item->id)?>">
			<?php echo $item->title;?></a></td>
		<td>
			<!--com_content line 129<?php //echo JHtml::_('jgrid.published', $item->state, $i, 'articles.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>-->
			<!--要注意$item->state、$i，article是controllers資料夾裡的前綴字article，它會自動產生article.task，-->
			<?php echo JHtml::_('jgrid.published', $item->state, $i, 'article.'); ?>
			<?php if($item->state): ?>
				<span class="label label-success">啟動</span>
			<?php else:?>
				<span class="label label-important">未發佈</span>
			<?php endif; ?>
		</td>
		<td><?php echo $item->category_title ? : '-'?></td>
		<td><?php echo $item->user_name ? : '-'?></td>
		<td><?php echo $item->created;?></td>
		<td><a class="btn btn-small" href="<?php echo JRoute::_('index.php?option=com_blog&task=article.delete&id='.$item->id)?>">
			<span class="icon-trash"></span>
		</td>
	<tr>
		
<?php
	}	
?>
</tbody>
	<tfoot>
		<tr>
			<td colspan="10">
				<?php echo $this->pagination->getListFooter();?>
			</td>
		</tr>
	</tfoot>
</table>	
</div>
</div>


	<input type="hidden" name="boxchecked" value="0">
 	<input type="hidden" name="option" value="com_blog">
  	<input type="hidden" name="task" value="">
</form>

