<?php
	//views/articles/view.html.php
	
	//命名規則：元件名稱View資料夾名稱
	class BlogViewArticle extends JViewLegacy{
		
		public function display($tpl = NULL){
			//登入否
			$user=JFactory::getUser();

			if($user->guest)
			{
				//throw new \Exception('please login first',403)
				
				$app=JFactory::getApplication();

				$return=JUri::getInstance()->toString();

				$return = base64_encode($return);

				$app->redirect(JRoute::_('index.php?option=com_users&view=login&return='.$return));

			}


			//等同於:執行下面2行
			//$model= $this->getModel();
			//$this->item=$model->getItem();
			$this->item=$this->get('Item');


			//$this->form=$this->get('Form');

			

			//echo $this->form->renderField('test');die;	


			$this->item = new JData($this->item);
			//Jdata是一個好用的物件，他幫你取值，沒取到值等多給空值，不會報錯
			//讓edit.php裡取值不會報錯

			//show($this->item);
			
			//呼叫events，發起一個事件
			$app= JFactory::getApplication();
			//第一個是event名字，array是參數，一個一個丟進去
			$app->triggerEvent('onSakuraBloom',array('sakura',$this->item));

			parent::display();
		}
		

	}

?>