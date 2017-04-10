<?php
	class modNewsHelper
	{
		public static function show($data)
		{
			echo '<pre>'.print_r($data,1).'</pre>';
		}

		public static function getArticles(JRegistry $params)
		{
			$db=JFactory::getDbo();

			$query=$db->getQuery(true);

			//filter
			
			$catids=(array)$params->get('catid',array());

			if(!empty($catids[0]))
			{
				$query->where(sprintf('article.catid in (%s)',implode(',', $catids)));
			}

			

			//limit
			$count = $params->get('count');

			//Order
			$ordering= $params->get('ordering','article.id');
			$direction = $params->get('direction','DESC');

			$query->order($ordering. ' ' .$direction);

			$selects=array('article.*',
				 'category.*',
				 'article.id as id',
				 'article.title as title',
				 'article.created as created',
				 'category.id as category_id',
				 'category.title as category_title',
				 'category.alias as category_alias'
				);

			//可以直接echo
			$query->select($selects)
				->from('#__blog_articles as article')
				->leftJoin('#__categories as category on category.id=article.catid');

			$items=$db->setQuery($query, 0, $count)->loadObjectList();

			//$items=$db->setQuery($query,$count)->loadObjectList();


			//static::show($items);die;

			foreach ($items as $item) 
			{
				$urlParams=array(
					'option' => 'com_blog',
					'view' => 'article',
					'id' => $item->id
				);

				//當場做出item的link，原本沒有
				$item->link=JRoute::_('index.php?'.http_build_query($urlParams));				

			}

			//static::show($items);die;

			return $items;
			
		}
	}
?>