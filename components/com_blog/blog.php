<?php
	//com_blog入口
	//include_once __DIR__.'/helpers/blog.php';
?>

<!--<h1>hello world<h1>-->
<?php
	//實用function

	//可以用他print出任何一個物件和陣列
	function show($data){
		echo '<pre>'.print_r($data,1).'</pre>';
	}

?>

<?php

//拿出http input 網址
$input=JFactory::getApplication()->input;


//呼叫blog controller
$controller = JControllerLegacy::getInstance('blog');

//拿出網址中的task
$task=$input->get('task');	//以後認識元件，要知道他做什麼，就從task，找下去


//執行task
$controller->execute($task);
//$controller->execute('go');
//$controller->execute('flower');


//結束後如果有需要，就重新導向
$controller->redirect();

?>
