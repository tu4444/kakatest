<?php
	//views/articles/view.html.php
	
	//命名規則：元件名稱View資料夾名稱
	class BlogViewArticles extends JViewLegacy{
		
		public function display($tpl = NULL){
			
			//1.
			//echo 'this is Article view';			
			
			//2.
			//因為tmpl在view物件裡面，所以tmpl也是view物件裡的東西，所以在view寫的東西，可以在tmpl裡用到
			//所以，在view.html.php可以寫函示，請tmpl的default.php做呈現
			$this->today=gmdate('Y-m-d');
			
			//show($this);	//可以將物件印出，看看自己有沒有寫錯
			
			//4/22：在view getmodel，並使用model的function
			$model = $this->getModel();

			$this->items = $model->getItems();


			//這樣寫的好處：沒有這個function頂多回傳空值，不會出錯
			$this->pagination=$this->get('Pagination');

			$this->state=$this->get('State');

			$this->addToolbar();

			//自動去找'tmpl'的'default.php'
			parent::display();
		}
		public function addToolbar(){
			
			BlogHelper::addSubmenu('articles');

			JToolbarHelper::title('Articles');	//頁面標題,icon
			JToolbarHelper::addNew('article.add');	//新增，用article.xxx是因為function已經被放到資料夾controllers的article
			JToolbarHelper::deleteList('Are you sure','article.delete');	//新增
			JToolbarHelper::publish('article.publish','開啟');	//第二個參數可以自訂內文
			JToolbarHelper::unpublish('article.unpublish');
			JToolbarHelper::trash('article.trash','垃圾桶');
		}
		
	}

?>