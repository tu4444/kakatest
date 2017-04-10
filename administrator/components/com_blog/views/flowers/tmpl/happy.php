<?php

	//layout
?>

<h1>this is flower's happy template<h1>

<?php
	show($this->items);
?>

<table class="table table-striped">
	<th>編號</th>
	<th>名稱</th>
<?php	foreach($this->items as $i=>$value){?>
	<tr>
		<td><?php echo $i+1;?></td>
		<td><?php echo '名稱'.$value;?></td>
	<tr>
		
<?php
	}	
?>
</table>