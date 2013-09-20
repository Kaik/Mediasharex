<?php

/**
 * Mediasharex
 *
 */
class Mediasharex_Handler_Installer extends Zikula_Form_AbstractHandler
{
    var $id;
     
    public function initialize(Zikula_Form_View $view)
    {


		// Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden(LogUtil::getErrorMsgPermission());
        }
     
        $id   = FormUtil::getPassedValue('id', isset($args['id']) ? $args['id'] : null, 'GETPOST');
           
		$this->id = $id;   
		              
        $view->caching = false;
		
			
        //$view->assign('revisions', ModUtil::apiFunc('Mediasharex', 'user', 'getrevisions', $this->pid));
        
     
      return true;

    }


    public function handleCommand(Zikula_Form_View $view, &$args)
    {
       if ($args['commandName'] == 'cancel') {                
            $id = null;
            $url = ModUtil::url('Mediasharex', 'user');
            return $this->view->redirect($url);
        }
		if ($args['commandName'] == 'save') {
				
 		var_dump($args);
		exit(0);
    	}
	}
}
	