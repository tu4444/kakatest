<!--以後只有layout=edit才會進入編輯頁面，-->
<?php
	//要講驗證
	JHtmlBehavior::formvalidator();
?>
<h1>Article edit</h1>
<script>
/*	Joomla.submitbutton = function(task)
	{
		if(task == "article.cancel" || document.formvalidator.isValid(document.getElementById("adminForm")))
		{
			Joomla.submitform(task,document.getElementById("adminForm"));
		}
	}*/
</script>

<form id="adminForm" method="post" action="<?php echo JUri::getInstance();?>" class="form-horizontal">

	<?php //echo $this->form->renderField('title');?>
	<?php //echo $this->form->renderField('alias');?>
	<?php //echo $this->form->renderField('created');?>
	<?php //echo $this->form->renderField('introtext');?>
	<?php //用form的方式將欄位印出來
	//一行一行印出來?>

	<?php
		//一次將所有的field印出來
		echo $this->form->renderFieldset('basic');
	?>



<!--	<div class="control-group">
    	<label class="control-label" for="title">Title</label>
    	<div class="controls">
      		<input type="text" id="title" placeholder="title" name="title" value="<?php //echo $this->item->title;?>">
    	</div>
  	</div>
-->

	<!--<input type="hidden" name="id" value="<?php //echo $this->item->id;?>">-->
	<!--由於用form來呈現表單，所以將id放到form的xml裡-->
  	<input type="hidden" name="option" value="com_blog">
  	<input type="hidden" name="task" value="">	<!--task value留空，因為按鈕會幫我们把task的值塞進去-->	 	 	 	
</form>