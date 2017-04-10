<?php
	
	//命名規則：元件名稱Model檔案名稱
	class BlogModelFlowers extends JModelLegacy{
		
		public function getItems(){
			
			return array(2,5,6,7,8,10,20);	//假設每一個都是一篇文章
		}
	}

?>