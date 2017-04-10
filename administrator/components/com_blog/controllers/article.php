<?php
	//寫多個controller
	class BlogControllerArticle extends JControllerLegacy{

		public function save(){	//需要被呼叫才能用
			//task可以指定要用controller的method
			//1.
			//show($this->input->post);
			

			$post=$this->input->post;
			
			//$data=array();
			//$data['id']=$post->getString('id');
			//$data['title']=$post->getString('title');	
			//$data['alias']=$post->getString('alias');
			//$data['introtext']=$post->getRaw('introtext');
			//$data['fulltext']=$post->getRaw('fulltext');	//getRaw避免將html過濾掉
			//$data['state']=$post->get('state');	//get會自動將中文、空白過濾掉
			//$data['created']=$post->getString('created');

			$data = $post->getVar('jform',array());
			//get array用getVar，加上array()是預設值，如果之後get不到value
			//由於form變成array將值傳過來，所以要用array抓值

			//save to session
			$app=JFactory::getApplication();
			$app->setUserState('com_blog.article.item.data',$data);

			//show($_SESSION);die; 

			$model = $this->getModel('Article');


	/*	//1.傳統寫法		
		if(!$model->save($data)){
				$this->setRedirect(JRoute::_('index.php?option=com_blog&view=article&layout=edit&id='.$data['id'],false),'儲存失敗','error');
				
				return false;
			}*/

			//2.新的寫法
			try{
				$form=$model->getForm(false);	//拿到空的form

				$form->bind($data);

				if(!$form->validate($data))
				{
					$errors=$form->getErrors();

					$app = JFactory::getApplication();

					foreach($errors as $error)
					{
						$app->enqueueMessage($error->getMessage(),'error');
					}

/*					$msgs='';

					foreach($errors as $error)
					{
						$msg.=$error->getMessage();
					}
*/

					throw new Exception('儲存失敗');

				}

				$model->save($data);
			}
			catch(Exception $e){
				$this->setRedirect(JRoute::_('index.php?option=com_blog&view=article&layout=edit&id='.$data['id'],false),$e->getMessage(),'error');
				
				return false;
			}

			//儲存成功就要把data的session除掉
			$app->setUserState('com_blog.article.item.data',null);

			$this->setRedirect(JRoute::_('index.php?option=com_blog&view=articles',false),'儲存成功','message');


			return true;
			//JRoute會幫我们處理網址，會幫我们前面加資料夾路徑
			//setRedirect第三個參數：message格式:message,success,warning,error,info

			//show($data);
		}

		public function apply(){

			if(!$this->save()){
				return false;
			}
			

			$return=JRoute::_('index.php?option=com_blog&view=article&layout=edit&id='.$this->input->get('id'),false);

			$this->setRedirect($return,'儲存成功','message');

			return true;

		}

	public function add(){

		//避免被殘留session影響
		JFactory::getApplication()->setUserState('com_blog.article.item.data',null);

		$url=JRoute::_('index.php?option=com_blog&view=article&layout=edit',false);

		$this->setRedirect($url);

		return true;	//養成習慣
	}


	public function edit(){
		
		//避免被殘留session影響
		JFactory::getApplication()->setUserState('com_blog.article.item.data',null);		

		$id=$this->input->get('id');

		$url=JRoute::_('index.php?option=com_blog&view=article&layout=edit&id='.$id,false);

		$this->setRedirect($url);
		
		return true;	//養成習慣
	}	

	public function delete(){

		$ids=$this->input->getVar('cid',array());

		$model = $this->getModel('Article');

		foreach ($ids as $id) {
			$model->delete($id);
		}
		
		//$id=$this->input->get('id');		

		$this->setRedirect(JRoute::_('index.php?option=com_blog&view=articles',false),sprintf('成功刪除 %s 個id',count($ids)),'note');
	}

		public function cancel(){
			
			//避免被殘留session影響
			JFactory::getApplication()->setUserState('com_blog.article.item.data',null);

			$this->setRedirect(JRoute::_('index.php?option=com_blog&view=articles',false));

			return true;
		}

		public function publish()
		{
			$ids=$this->input->getVar('cid',array());

			$model = $this->getModel('Article');

			foreach ($ids as $id) {
				//$model->publish($id);
				$model->changestate($id,'state',1);
			}
			
			//$id=$this->input->get('id');		

			$this->setRedirect(JRoute::_('index.php?option=com_blog&view=articles',false),sprintf('成功發佈 %s 個id',count($ids)),'note');
		}

		public function unpublish()
		{
			$ids=$this->input->getVar('cid',array());

			$model = $this->getModel('Article');

			foreach ($ids as $id) {
				//$model->unpublish($id);
				//改用一個changestate蓋掉需寫兩種function:publish、unpublish
				$model->changestate($id,'state',0);
			}
			
			//$id=$this->input->get('id');		

			$this->setRedirect(JRoute::_('index.php?option=com_blog&view=articles',false),sprintf('成功關閉 %s 個id',count($ids)),'note');
		}


	}
?>