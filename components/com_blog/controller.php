<?php


//命名規則：元件名稱Controller
//負責召喚model和view，將models拿到的資料給view，view呈現給使用者看
//這就是一組MVC做的事情
class BlogController extends JControllerLegacy{
	
	public function display($cachable = false, $urlparams = array()){	//不管task=什麼(display)，或是沒有參數
								//，都是進來display，它是預設
		//1.
		//echo 'display';	//下一步，用view
		
		//2.
		//$view=$this->getView('Articles','html');	//html參數一定要寫，否則會錯，拿出view物件
		//getView：
		//會自動去找views資料夾底下的，與'Articles'同名資料夾裡的'view.html.php'(固定名字)
		
		//3.
		$viewName=$this->input->get('view','articles');		//&view=什麼參數，對應views裡不同的資料夾
		$viewLayout=$this->input->get('layout');	//&layout=什麼參數，對應views/tmpl的其他不是default的檔案
		


		$view=$this->getView($viewName,'html');

				
		//get Model：會自動去找models資料夾底下的與'Articles'同名的檔案
		//$model=$this->getModel('Articles');		
		//$articles=$model->getArticles();	//直接取出model的東西
		
		$model=$this->getModel($viewName);

		//4/29 
		$id=$this->input->get('id');

		if($id){
			$model->setState('item.id',$id);
		}		

		//4.
		//$view->items=$model->getItems();	//把models的東西塞給view
		//應改由view決定拿單複數，由view自己做

		//5.把model塞給view
		$view->setModel($model,true);	//加true是制式的寫法，coctroller只做一件事，把model塞給view

		
		//show($articles);die;
		
		//$view->articles=$articles;	//把models的東西直接塞到view的articles:把model得到的資料給view用
		
		
		//$view->setLayout($viewLayout);
		
		
		$view->display();	//view做呈現
		
	}
	
	

	

}

?>