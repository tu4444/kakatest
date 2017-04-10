<?php
	class BlogRouter extends JComponentRouterBase
	{
		//給人看:$queries進來轉成$segments
		public function build(&$queries)
		{
			$segments=array();

			if(isset($queries['view']))
			{
				$segments[]=$queries['view'];
				unset($queries['view']);

				if(isset($queries['id']))
				{
					$segments[]=$queries['id'];
					unset($queries['id']);
				}				
			}

			return $segments;
		}

		//給joomla看:/{view}/{id}
		//也有可能有這種狀況：/article/edit，要將所有可能考慮進去
		//$segments進來轉成$queries
		public function parse(&$segments)
		{
			$queries=array();

			$order = array('view','id');

			foreach($order as $key=>$order)
			{
				$queries[$order] = $segments[$key];
			}

			//$queries['view'] = $segments[0];
			//$queries['id'] = $segments[1];

			//$id=$input->get('id'); queries就是input，
			//因為在parse有將segment塞給queries，所以才能使用$input->get('id');
			//所以，一開始想抓網址的什麼東西，在parse要寫好

			return $queries;
		}
	}
?>