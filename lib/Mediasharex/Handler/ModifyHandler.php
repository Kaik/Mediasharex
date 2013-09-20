<?php
/**
 * Mediasharex
 *
 */
class Mediasharex_Handler_ModifyHandler extends Zikula_Form_AbstractHandler
{
    var $handler;
         
    public function initialize(Zikula_Form_View $view)
    {

        // Security check
		//$view->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
     
        $name   = FormUtil::getPassedValue('name', isset($args['name']) ? $args['name'] : null, 'GETPOST');         
		$this->handler['handler'] = $name;
		$view->assign('handler_name', $name);   		              
        $view->caching = false;

		$h['handler'] = ucfirst($name);		
        $handlerManager = new Mediasharex_Manager_MediaHandler(null,$h);		
        if (!$handlerManager->exist()) {        	
        return true;
		}	
        $handlerManager->loadfile();
        $handler = $handlerManager->loadHandler();		             
        $view->assign('handler_info', $handler->getInfo());		
		$settings =  ModUtil::getVar('Mediasharex','handler_'.$name,false);		
		if(!$settings){			
		$settings = $handler->getDefaultSettings();			
		}		
        $view->assign('settings', $settings);		
		//redirect
        $view->assign('redirect', (isset($redirect) && !empty($redirect)) ? true : false);

  
      return true;
    }


    public function handleCommand(Zikula_Form_View $view, &$args)
    {
        
        if ($args['commandName'] == 'cancel') {                
            $id = null;
            $url = ModUtil::url('Mediasharex', 'user');
            return $this->view->redirect($url);
        }
		
		if ($args['commandName'] == 'update') {
			
		$data = $this->view->getValues();		
		$handler_name = $data['handler_name'];	
		//var_dump($handler_name);
		//exit(0);

		if ($handler_name == ''){			
        return $this->view->redirect($data['redirect']);			
		}

		$saved = ModUtil::setVar('Mediasharex','handler_'.$handler_name, $data['settings']);

        return $this->view->redirect($data['redirect']);
    	}
	}
}

