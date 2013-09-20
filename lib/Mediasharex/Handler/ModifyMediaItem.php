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
		$this->item = $itemManager->getItemArray();		             
	    $item = $this->item;       
        // finally asign the item information
		$view->assign($item);         
        $view->assign('media', $item);			
		
		$previews = $itemManager->getPreviews();
        $view->assign('media_previews', $previews);		

		$sourcesManager = new Mediasharex_Manager_MediaSources();	 
		$sources = $sourcesManager->getAll();									
        $view->assign('sources', $sources);			

        $view->assign('catreg', CategoryRegistryUtil::getRegisteredModuleCategories('Mediasharex', 'mediasharex_media'));
 		
		//redirect
        $view->assign('redirect', (isset($redirect) && !empty($redirect)) ? true : false);

  
      return true;



		/*
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
		*/
		
    }


    public function handleCommand(Zikula_Form_View $view, &$args)
    {
    	
		$data = $this->view->getValues();
		
        
        if ($args['commandName'] == 'cancel') {                


        }

		if ($args['commandName'] == 'check') { 						
		//var_dump($data);
		//exit(0);		
		return false;
		
		}
		
		if ($args['commandName'] == 'save') {
		//var_dump($data);
		//exit(0);		
		return false;

		}

		if ($args['commandName'] == 'update') {
			
			
			
			
		//echo ('<pre>');	
		//var_dump($data);
		//exit(0);

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
		
			$mediaManager = new Mediasharex_Manager_MediaItem(false,$item);		
			$saved = $mediaManager->save();
			
			if($saved){
	        // update successfuly
	        LogUtil::registerStatus($this->__('Done! media updated.'));			
			}else{
	        // update failed
	        LogUtil::registerError($this->__('Update failed'));				
			}
						
			//redirect			
            return $this->view->redirect($data['redirect']);						
			
			
		}

		if ($args['commandName'] == 'delete') {
			
			
		//delete previews (mediastoreitems) first	
		
		
		//delete media item
		
		
		
		// redirect to parent album
			
		//var_dump($data);
		//exit(0);		
		return false;
			
		}
		

    }
}
	