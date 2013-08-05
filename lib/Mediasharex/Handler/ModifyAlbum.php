<?php
/**
 * Mediasharex
 *
 */
class Mediasharex_Handler_ModifyAlbum extends Zikula_Form_AbstractHandler
{
    var $id;
    var $item;
         
    public function initialize(Zikula_Form_View $view)
    {


		// Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_COMMENT)) {
            throw new Zikula_Exception_Forbidden(LogUtil::getErrorMsgPermission());
        }
     
        $id   = FormUtil::getPassedValue('id', isset($args['id']) ? $args['id'] : null, 'GETPOST');
        $redirect   = FormUtil::getPassedValue('redirect', isset($args['redirect']) ? $args['redirect'] : null, 'GETPOST');		         
		$this->id = $id;   		              

		$access = Mediasharex_Util_Access::getAccessSelect();
		$view->assign('access_select',$access);		
		
		$themes = Mediasharex_Util_AlbumThemes::getThemesSelect();
		$view->assign('themes_select',$themes);
		
		$albumManager = new Mediasharex_Manager_Album($id);
		$this->item = $albumManager->getItemArray();		             
	    $item = $this->item; 
        $view->assign($item);
		$view->assign('album',$item);
		 
		$view->assign('subalbums',$albumManager->getSubAlbums());
		$view->assign('mediaitems',$albumManager->getMediaItems());
		//$view->assign('mainitem2',$albumManager->getMainmedia());		
		//redirect
        $view->assign('redirect', (isset($redirect) && !empty($redirect)) ? true : false);
 		$this->view->caching = Zikula_View::CACHE_DISABLED;
  
      return true;
    }


    public function handleCommand(Zikula_Form_View $view, &$args)
    {
    		
        
        if ($args['commandName'] == 'cancel') {
        	                
			//$data = $this->view->getValues();
            return $this->view->redirect($data['redirect']);
        }

        if ($args['commandName'] == 'save') {
        	                
			//$data = $this->view->getValues();
						
            return $this->view->redirect($data['redirect']);
        }		
		
		

       if ($args['commandName'] == 'update') {


			$data = $this->view->getValues();		
			//$id = $this->id;                
            $item = $this->item;
				
			//validation		
            $ok = true; 	


			if($data['title'] == '') {				
				$plugin = $this->view->getPluginById('title');
				$plugin->isValid = false;				
                $errorPlugin = $this->view->getPluginById('error_title');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Title is missing'));
                $ok = false;
			}else {            
				$plugin = $this->view->getPluginById('title');
				$plugin->isValid = true;				
				$errorPlugin = $this->view->getPluginById('error_title');
                $errorPlugin->message = '';
            }	



	
			//Update					
			if(empty($id)){			
		    $item = array_merge($item, $data);
			}else {
			$item = array_merge($item, $data);					
			}
		
			$albumManager = new Mediasharex_Manager_Album(false,$item);		
			$saved = $albumManager->save();
			
			if($saved){
	        // update successfuly
	        LogUtil::registerStatus($this->__('Done! Album updated.'));			
			}else{
	        // update failed
	        LogUtil::registerError($this->__('Update failed'));				
			}
						
			//redirect			
            return $this->view->redirect($data['redirect']);						
	   }
				

	}
}
