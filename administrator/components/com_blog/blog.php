<?php
	//com_blog�J�f
	include_once __DIR__.'/helpers/blog.php';
?>

<!--<h1>hello world<h1>-->
<?php
	//���function

	//�i�H�ΥLprint�X����@�Ӫ���M�}�C
	function show($data){
		echo '<pre>'.print_r($data,1).'</pre>';
	}

?>

<?php

//���Xhttp input ���}
$input=JFactory::getApplication()->input;


//�I�sblog controller
$controller = JControllerLegacy::getInstance('blog');

//���X���}����task
$task=$input->get('task');	//�H��{�Ѥ���A�n���D�L������A�N�qtask�A��U�h


//����task
$controller->execute($task);
//$controller->execute('go');
//$controller->execute('flower');


//������p�G���ݭn�A�N���s�ɦV
$controller->redirect();

?>
