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
        $view->caching = false;
		
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
				
            $ok = true;        	
			/*
			$new_img_upload = $this->getNewImages();
			
					
			$new_img_arr = $new_img_upload['images'];						
			$data = $this->view->getValues();	
			$this_img_arr = unserialize($data['img']);
			
			$delete_arr   = FormUtil::getPassedValue('delete', isset($args['delete']) ? $args['delete'] : null, 'GETPOST');
			foreach ($delete_arr as $k => $delete){				
			if($delete){
			unset($this_img_arr[$k]);	
			}									
			}
			
			foreach($new_img_arr as $key => $image){
			if ($image['file_name'] != false){	
			$this_img_arr[] = $image;
			}
			}			

			//$this_img_arr = unserialize($this->item['img']);
			
			if(count($this_img_arr) <= 3) {
                $errorPlugin = $this->view->getPluginById('error_img');
                $errorPlugin->message = '';
			}else {            
				$errorPlugin = $this->view->getPluginById('error_img');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Up to 3 images allowed'));
				$ok = false;	
            	array_splice($this_img_arr, 3);	
			}	
			
	

			//$data['img'] = serialize($img_arr);
			//$old_img = $this->item['img'];	
			$data['img'] = serialize($this_img_arr);
			//$this->item['img'] = serialize($mixed_img_arr);
            $view->assign('images_preview', $this_img_arr);
			//$view->assign('post_images', $data['img']);
			//$view->assign('img', $data['img']);
			$postplugin = $this->view->getPluginById('img');
			$postplugin->text = $data['img'];		
			//$view->assign('img', serialize($new_images));			
			//$new_images = $this->getNewImages();

			*/		
			
			$data = $this->view->getValues();
			//var_dump($data);
			//exit(0);
			

				
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
			if($data['urltitle'] == '') {				
				$plugin = $this->view->getPluginById('urltitle');
				$plugin->isValid = false;
                $errorPlugin = $this->view->getPluginById('error_urltitle');
				$errorPlugin->message = strtolower(DataUtil::formatPermalink($data['title']));
				$errorPlugin->cssClass = 'z-statusmsg' ;
				$data['urltitle'] = strtolower(DataUtil::formatPermalink($data['title']));
                $ok = false;
            }else {
				$plugin = $this->view->getPluginById('urltitle');
				$plugin->isValid = true;				
                $errorPlugin = $this->view->getPluginById('error_urltitle');
				$errorPlugin->message = '';           					
            }
            if($data['__CATEGORIES__']['Cat'] == '') {            	
				$plugin = $this->view->getPluginById('Cat');
				$plugin->isValid = false;
				
                $errorPlugin = $this->view->getPluginById('error_cat');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Category is missing'));
                $ok = false;
            }else {
				$plugin = $this->view->getPluginById('Cat');
				$plugin->isValid = true;				
                $errorPlugin = $this->view->getPluginById('error_cat');
                $errorPlugin->message = '';				
            }
					             
            if (!$ok){
            
            return false;				
            }
			//we will react base on those attributies so save them
			$data['__ATTRIBUTES__']['showgallery'] = $data['showgallery'];
			$data['__ATTRIBUTES__']['gtype'] = $data['gtype'];				
			$data['__ATTRIBUTES__']['state'] = $data['state'];			
			
			$id = $this->id;                
            $item = $this->item;
			
			if ($data['ajax_logo'] != ''){
				//ajax logo				
				$logo['file_name'] = $data['ajax_logo'];				
				$data['logo'] = serialize($logo);
			}else if ($data['logo_upload']['name'] != ''){
				//process no ajax image upload
				$logo['file_name'] = $data['ajax_logo'];	
				$data['logo'] = serialize($logo);	
			}else{							
				$data['logo'] = serialize($item['logo']);					
			}
			
			
			
			
			
				
			if(empty($id)){						
					$item = array_merge($item, $data);								            
		            $date = new DateTime('now');
		            $item['publishdate'] = $date->format('Y-m-d H:i:s');														
					//create
		            $id = ModUtil::apiFunc('Mediasharex', 'user', 'create', $item);
		            if ($id === false) {
		                return $this->view->registerError(null);
		            }										
			}else{				
					$item = array_merge($item, $data); 					
					//update
					$ok = ModUtil::apiFunc('Mediasharex', 'user', 'update', $item);
            		if ($ok === false) {
                	return $this->view->registerError(null);
            		}	
			
			}
          //item created/updated redirect url 	
         $url = ModUtil::url('Mediasharex', 'user', 'manager');            
      

		} else if ($args['commandName'] == 'delete') {            
            $ok = ModUtil::apiFunc('Mediasharex', 'user', 'delete', array('id' => $id));
            if ($ok === false) {
            return $this->view->registerError(null);
            }   
            $id = null;
            $url = ModUtil::url('Mediasharex', 'user');
        }
        return $this->view->redirect($url);
    }
}

			//FormUtil::clearValidationErrors();				
			//$data['img_ajax'] = $img_ajax['img_ajax'];
			//SessionUtil::setVar('biuid','aaaaa');
			//var_dump($post_img);
			//exit(0);	
			//$this->image = $data['img_ajax'];
			            /*
            if($data['__CATEGORIES__']['Cat'] == '') {            	
				$plugin = $this->view->getPluginById('Cat');
				$plugin->isValid = false;
				
                $errorPlugin = $this->view->getPluginById('error_cat');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Category is missing'));
                $ok = false;
            }else {
				$plugin = $this->view->getPluginById('Cat');
				$plugin->isValid = true;				
                $errorPlugin = $this->view->getPluginById('error_cat');
                $errorPlugin->message = '';				
            }
             
            if($data['__CATEGORIES__']['Topic'] == '') {            	
				$plugin = $this->view->getPluginById('Topic');
				$plugin->isValid = false;				
                $errorPlugin = $this->view->getPluginById('error_topic');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Topic is missing'));
                $ok = false;
            }else {
				$plugin = $this->view->getPluginById('Topic');
				$plugin->isValid = true;				
                $errorPlugin = $this->view->getPluginById('error_topic');
                $errorPlugin->message = '';                           					
            }
			 * 
			 			  	               
            if(isset($data['img']['name']) && $data['img']['size'] > 1500000){            	
				$plugin = $this->view->getPluginById('img');
				$plugin->isValid = false;                	
                $errorPlugin = $this->view->getPluginById('error_img');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Image is too big alowed up to 1,5MB'));
                $ok = false;                        
			}else {
				$plugin = $this->view->getPluginById('img');
				$plugin->isValid = true;                	
                $errorPlugin = $this->view->getPluginById('error_img');
                $errorPlugin->message = '';                           					
            }			
			 */ 	