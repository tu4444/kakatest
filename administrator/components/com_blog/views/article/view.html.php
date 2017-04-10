<?php
	//views/articles/view.html.php
	
	//命名規則：元件名稱View資料夾名稱
	class BlogViewArticle extends JViewLegacy{
		
		public function display($tpl = NULL){
			//等同於:執行下面2行
			//$model= $this->getModel();
			//$this->item=$model->getItem();
			$this->item=$this->get('Item');


			$this->form=$this->get('Form');

			

			//echo $this->form->renderField('test');die;	


			$this->item = new JData($this->item);
			//Jdata是一個好用的物件，他幫你取值，沒取到值等多給空值，不會報錯
			//讓edit.php裡取值不會報錯

			//show($this->item);
			
			$this->addToolbar();

			parent::display();
		}
		

		public function addToolbar(){
			JToolbarHelper::title('Article Edit','edit');	//頁面標題,icon
			JToolbarHelper::apply('article.apply');
			JToolbarHelper::save('article.save');
			JToolbarHelper::cancel('article.cancel');		
			//article.save會區隔controller的名稱
			//送到task=save的網址，joomla的button是用javascript運作
		}
	}

?>