<?php
	class BlogTableArticle extends Jtable
	{
		//Jtable用來處理一筆紀錄load.store.delete.update

		public function __construct($db){
			parent::__construct('#__blog_articles','id',$db);
		}

		public function check(){

			//$errorMessage = array();	//將錯誤都存在array，之後再將所有的錯誤發出來

			if(!trim($this->title)){
				throw new Exception('請輸入標題');
			}

		}

		public function store($updateNulls = false){
			if(!trim($this->created)){
				//$date = new JDate('now','Asia/Taipei');	//這樣才會存台北時區
				//根據全站設定轉換
				$date = new JDate('now',JFactory::getConfig()->get('offset','UTC'));
				//看這個網站全站設定的時區

				$this->created=$date->toSql(true);	
			}

			return parent::store($updateNulls);

		}


	}
?>