<?php
	//views/articles/view.html.php
	
	//命名規則：元件名稱View資料夾名稱
	class BlogViewFlowers extends JViewLegacy{
		
		public function display(){
			
			//1.
			//echo 'this is Article view';			
			
			//2.
			//因為tmpl在view物件裡面，所以tmpl也是view物件裡的東西，所以在view寫的東西，可以在tmpl裡用到
			//所以，在view.html.php可以寫函示，請tmpl的default.php做呈現
			//$this->today=gmdate('Y-m-d');
			
			//show($this);	//可以將物件印出，看看自己有沒有寫錯
			
			//自動去找'tmpl'的'default.php'
			parent::display();
		}
		
	}

?>