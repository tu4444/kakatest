<?php

	//命名規則：元件名稱Model檔案名稱
	class BlogModelArticles extends JModelLegacy{
		
		//setState不會影響之後的頁面，是model的session，是區域的儲存空間
		//setUserState是全域的儲存空間，可以跨model
		//會在第一次執行getState前執行，自動儲存起來
		public function populateState()
		{
			$app=JFactory::getApplication();
			$this->setState('list.limit',5);
			$this->setState('list.start',$app->input->get('limitstart',0));

			//search
			$search=$app->input->getString('search');

			$this->setState('list.search',$search);

			//Filter
			$state=$app->input->get('filter_state');
			$this->setState('list.filter_state',$state);
		}

		public function getItems(){
			
			//1.
			//return array(1,2,3,4,5,6,7,8,9,10);	//假設每一個都是一篇文章

			//get database object
			$db = JFactory::getDbo();

			//select all columns from this table;#__ joomla會自動代換前綴字
			//$query = "select * from #__blog_articles";

			$input=JFactory::getApplication()->input;
			//pagination可以自己設定
			$limit=$this->getState('list.limit',5);
			$start=$this->getState('list.start',0);


			$selects =array(
				'article.*','cat.*','user.*','article.id as id',
				'article.title as title',
				'article.created as created',
				'article.state as state',
				'cat.id as category_id',
				'cat.title as category_title',
				'user.id as user_id',
				'user.name as user_name'
				);

			$query = "select SQL_CALC_FOUND_ROWS ".implode(', ',$selects).
			" from #__blog_articles as article ".
			" left join #__categories as cat on cat.id= article.catid ".
			" left join #__users as user on user.id = article.author ";
			//SQL_CALC_FOUND_ROWS:對應FOUND_ROWS();

			
			$where=array();

			//filter
			$filterstate=$this->getState('list.filter_state','');

			if($filterstate!=='')
			{
				$where[] = " article.state = ".$filterstate;
			}
			

			//search
			$search = $this->getState('list.search');
			//echo $search;die;
			if($search)
			{
				//$where = "title like '%abc%'";
				$where[] = " article.title like '%".$search."%' ";
			}

			if($where)
			{
				$query.=' where '. implode(' AND ',$where);
			}
			

			//set query into database object
			$db->setQuery($query,$start,$limit);

			//execute this 
			return $db->loadObjectList();

		}

		public function getPagination()
		{
			$db=JFactory::getDbo();	

			$sql="Select FOUND_ROWS();";

			$total=$db->setQuery($sql)->loadResult();

			$limit=$this->getState('list.limit',5);
			$start=$this->getState('list.start',0);	

			return new JPagination($total,$start,$limit);		
		}
				
	}

?>