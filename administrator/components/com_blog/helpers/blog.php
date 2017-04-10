<?php
	class BlogHelper
	{
		public static function addSubmenu($vName)
		{
			//當$vName丟了什麼東西進來，就會將那一選項高亮
			JHtmlSidebar::addEntry(
				'文章',
				'index.php?option=com_blog&view=articles',
				$vName=='articles'
			);

			JHtmlSidebar::addEntry(
				'分類',
				'index.php?option=com_categories&extension=com_blog',
				$vName=='categories'
			);
		}
	}
