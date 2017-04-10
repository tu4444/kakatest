<?php
	class PlgSystemSakura extends JPlugin
	{
		//開啟網站時啟動
		public function onAfterInitialise()
		{
			//echo 'YOO~';
		}

		//更改文章內容;$context判斷環境
		public function onContentPrepare($context,&$article,$params,$page)
		{
			echo $context;

			if($context!='com_content.article')
			{
				return;
			}

			$article->text.='YOO~~';
		}

		public function onSakuraBloom($context,$item)
		{
			$item->fulltext.='Bloom~~~`';
		}

	}
?>