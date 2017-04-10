<h1>this is article page</h1>
<?php
	//show($this->item);
?>

<div class="blog-articles">

	<div class="row-fluid">
		<div class="span12">
			<article>
					<header>
						<h2><?php echo $this->escape($this->item->title);?></h2>
						<p style="color:#999;">
							分類：<?php echo $this->escape($this->item->category->title);?>
							| 
							作者：<?php echo $this->escape($this->item->user->name);?>
						</p>
					</header>
					<div class="article-content">
						<?php echo $this->item->introtext;?>
						<?php echo $this->item->fulltext;?>						
					</div>
			</article>

		</div>
	</div>	
	
</div>