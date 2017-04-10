<!--<h1>Default tmpl</h1>-->

<?php
	

?>

<ul>
	<?php
		foreach ($items as $key => $item) {
	?>
	<li>
		<a href="<?php echo $item->link;?>">
		<?php echo $item->title;?>
		</a>

	</li>

			
	<?php }
	?>

</ul>