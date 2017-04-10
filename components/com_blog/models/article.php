<?php

	//命名規則：元件名稱Model檔案名稱
	class BlogModelArticle extends JModelLegacy{

		//Proxy
		public function getTable($name='Article',$prefix='BlogTable',$options=array()){
			return parent::getTable($name,$prefix,$options);
		}
		public function save($data){

			//save to session
			//在model用seesion要呼叫JFactory
			//$app=JFactory::getApplication();
			//$app->setUserState('com_blog.article.item.data',$data);

			//1.
			//$table=$this->getTable('Article','BlogTable');
			//2.代理funcion
			$table=$this->getTable();

			$table->load($data['id']);	//將資料load近來存在table

			//bind data into this table
			$table->bind($data);

			//check some fields
			$table->check();

			//do save action
			$table->store(true);	//設成true才能存空值

			return true;

		}



		public function getItem($id=null){
					
			$app= JFactory::getApplication();
			$item=$app->getUserState('com_blog.article.item.data');
			//那就是存進去的session名稱，用了什麼名稱，之後就用什麼名稱取出

			if($item){
				return $item;
			}

			
			//如果沒拿到session就要取id拿資料
			//1.
			//$id=$input->get('id');
			//2.
			$id=$id ? : $this->getState('item.id');	//如果沒有id直接塞進來，就拿state存的id

			if(!$id){
				return null;
			}

			$table=$this->getTable();

			//$table->load($id);

			//5/27
			if($table->load($id))
			{
				//category
				//$catTable=JTable::getInstance('Category');
				//也可以寫成
				//$catTable=$this->getTable('Category','JTable');
				$catTable=$this->getTable('Category','JTable');
				$catTable->load($table->catid);
				
				$table->category=$catTable;

				//user
				$table->user=JFactory::getUser($table->author);
			}

			return $table->getProperties();

		}

		public function delete($id){
			$table=$this->getTable();

			return $table->delete($id);
			
		}

		public function getForm($loadData=true)
		{
			//$form=JForm::getInstance('article.form');
			//$form=new JForm('article.form');
			$form=new JForm('article.form',array('control'=>'jform'));
			//讓每個input的name都加上jfome[]，變成array

			//$form->load('<form><field name="test"/></form>');
			$form->loadFile(__DIR__.'/forms/article.xml');
			//__DIR__任何php都可以用，表示現在所在的目錄位置

			

			if($loadData){
				$item=$this->getItem();
				$form->bind($item);
			}//否則我拿到一個空的form
			

			return $form;
		}


		public function publish($id)
		{
			$table=$this->getTable();

			$table->load($id);	//如果先把東西load進來，就可以不用將true加到store

			$table->state=1;

			$table->store(true);

			return true;

		}

		public function changestate($id,$field='state',$value=1)
		{
			$table=$this->getTable();

			$table->load($id);	//如果先把東西load進來，就可以不用將true加到store

			$table->$field=$value;

			$table->store(true);

			return true;			
		}

	}

?>