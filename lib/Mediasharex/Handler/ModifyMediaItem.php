<?php
/**
 * Mediasharex
 *
 */
class Mediasharex_Handler_ModifyMediaItem extends Zikula_Form_AbstractHandler
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
		$this->id = $id;   		              
        $view->caching = false;

		
		$itemManager = new Mediasharex_Manager_MediaItem($id);
		//$itemManager->includeStoreItem(); 
		$this->item = $itemManager->getItemArray();		             
	    $item = $this->item; 
        // finally asign the item information

		
		
		if($id <= 0){
		$sourcesManager = new Mediasharex_Manager_MediaSources();	 
		$sources = $sourcesManager->getAll();									
        $view->assign('sources', $sources);			
		}
		
		$view->assign('isPostBack', false);
				
		if($view->isPostBack()){
	        //if(!$view->isValid){
				
			$view->assign('isPostBack', true);					
			
			//$sdata = array();				
			foreach ($sources  as $key => $source) {			
			$sourceManager = new Mediasharex_Manager_MediaSource(null,$source);	
			$sdata[$source['name']] = $sourceManager->readPost($view);
			///
			if($sdata[$source['name']]['pre_item']){
			$item = array_merge($item,$sdata[$source['name']]['pre_item']);
				$titlePlugin = $view->getPluginById('title');									
				$titlePlugin->text = $item['title'];				
			    $titlePlugin->decode($view);				
			}
			
			}
       		//$view->assign('_item', $item);			
			//$sdata = $this->view->getValues();
       		$view->assign('sdata', $sdata);			
				
				
						        					
			//var_dump($sdata);
			//exit(0);				
			//}
		}		
		
		
		
		$view->assign($item); 
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

		if ($args['commandName'] == 'check') { 						

		$data = $this->view->getValues();
		//var_dump($data);
		//exit(0);		
		return false;
        //return $this->view->redirect($url);		
		}
		
		if ($args['commandName'] == 'save') {
		//var_dump($data);
		//exit(0);		
		return false;
        //return $this->view->redirect($url);			
			
			
		}

		if ($args['commandName'] == 'update') {
		//var_dump($data);
		//exit(0);		
		return false;
        //return $this->view->redirect($url);			
			
			
		}

		if ($args['commandName'] == 'delete') {
		//var_dump($data);
		//exit(0);		
		return false;
        //return $this->view->redirect($url);			
			
			
		}
		

    }
}
	