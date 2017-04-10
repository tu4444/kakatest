<h1>this is article default view</h1>
<?php
	
	//show($this->items);

	
?>

<div class="blog-articles">
	<?php
		foreach($this->items as $item){
	?>
	<div class="row-fluid">
		<div class="span12">
			<article>
					<header>
						<h2 class="article-title">
							<a href="<?php echo JRoute::_('index.php?option=com_blog&view=article&id='.$item->id);?>">
							<?php echo $this->escape($item->title);?>
							</a>
						</h2>
						<p style="color:#999;">
							分類：<?php echo $this->escape($item->category_title);?>
							| 
							作者：<?php echo $this->escape($item->user_name);?>
						</p>
					</header>
					<div class="article-content">
						<?php echo $item->introtext;?>
						
					</div>
			</article>

		</div>
	</div>

	<?php }?>

	<div class="pagination">
		<?php echo $this->pagination->getListFooter();?>
	</div>
	
	
</div>