<?php

/**
 * Mediasharex
 *
 */
class Mediasharex_Handler_ModifyAjax extends Zikula_Form_AbstractHandler
{
    var $id;
    var $pid;
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
		
		
		if(empty($id)){
			
		// build new object
        $this->item = array('pid'       => 0,
                     'online'           => 0,
                     'indepot'          => 0,
                     'revision'         => 0,
                     'showinmenu'       => 1,
                     'showinlist'       => 1,
                     'publishdate'      => null,
                     'expiredate'       => null,
                     'language'         => null,
                     'hitcount'         => 0,
                     'author'           => UserUtil::getVar('uid'),
                     'urltitle'         => '',
                     'img_note'         => '',
                     'img'              => null,
                     'notes'            => '',
                     'content'          => '',
                     'teaser'           => '',
                     'title'            => '',
                     'event_date'       => null
                     );
			
			
		}else{
			
			
		$this->item = ModUtil::apiFunc('Mediasharex', 'user', 'getitem', array('id' => $id));
		    
		if ($this->item == false || !is_array($this->item)) {
		            return LogUtil::registerError($this->__('No such item found.'), ModUtil::url('Mediasharex', 'user', 'main'));
		}
               			
		

		}
		               
        // get some permissions to use in the cache id and later to filter template output
        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_DELETE) ) {
            $edit = true;
            $delete = true;
        } elseif (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_EDIT) ) {
            $edit = true;
            $delete = false;
        } else {
            $edit = false;
            $delete = false;
        }  
        
		
		 // Check for the current user to enable users to edit their own articles
	    if (UserUtil::isLoggedIn()) {
	        $uid = UserUtil::getVar('uid');
	    } else {
	        $uid = 0;
	    }
	       
	    
	    $item = $this->item; 
	       
	    if ($uid !== $item['author'] ){
		  if (!SecurityUtil::checkPermission('Mediasharex:Edit:','::', ACCESS_EDIT)) {
		            throw new Zikula_Exception_Forbidden(LogUtil::getErrorMsgPermission());
		  }
		}
	        
	        
	    $this->pid = $this->item['pid'];
	        
	        
	    $item['img'] = unserialize($item['img']);
	        
        if($this->isPostBack){		
			if($this->isValid){
			$data = $view->getValues();				
			$item = $data;	
			}				
		}
		
		 
        // finally asign the item information
        $view->assign($item)
              ->assign('edit',            $edit)
              ->assign('delete',          $delete);
		$view->assign('action', ModUtil::url('Mediasharex', 'user', 'display', array('id' => $id)));
        $view->assign('catreg', CategoryRegistryUtil::getRegisteredModuleCategories('Mediasharex', 'mediasharex'));
        $view->assign('redirect', (isset($redirect) && !empty($redirect)) ? true : false);
        //$view->assign('revisions', ModUtil::apiFunc('Mediasharex', 'user', 'getrevisions', $this->pid));
        
     
      return true;

    }

    public function handleCommand(Zikula_Form_View $view, &$args)
    {
        

        if ($args['commandName'] == 'cancel') {
                
			return new Zikula_Response_Ajax(array('cancel' => true));
        }
        
       if ($args['commandName'] == 'save') {
            
       
	   $element = isset($args['element']) ? $args['element'] : FormUtil::getPassedValue('element', false, 'GETPOST');
	   
       $data = $view->getValues();
        							 
       $ok = true;
	      
		  
	   
	   if ($element){
	   	
		switch ($element) {
			case 'topic':
            if($data['__CATEGORIES__']['Topic'] == '') {
            	
				$plugin = $this->view->getPluginById('Topic');
				$plugin->isValid = false;
				
                $errorPlugin = $this->view->getPluginById('error_topic');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Topic is missing'));
                $ok = false;
            }
			break;
			case 'category':
            if($data['__CATEGORIES__']['Cat'] == '') {
            	
				$plugin = $this->view->getPluginById('Cat');
				$plugin->isValid = false;
				
                $errorPlugin = $this->view->getPluginById('error_cat');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Category is missing'));
                $ok = false;
            } 				
			break;
			case 'image':
			if(isset($data['img']['name']) && $data['img']['size'] > 1500000){
            	
				$plugin = $this->view->getPluginById('img');
				$plugin->isValid = false;
                	
                $errorPlugin = $this->view->getPluginById('error_img');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Image is too big alowed up to 1,5MB'));
                $ok = false;            
            
			} 	
			break;			
			default:
			 if($data[$element] == '') {
				
				$plugin = $view->getPluginById($element);
				$plugin->isValid = false;
				
                $errorPlugin = $view->getPluginById('error_'.$element);
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Element is missing'));
              $ok = false;
        	}	
				break;
		}
				
		
	   } else {
	   		   	                      
			if($data['title'] == '') {
				
				$plugin = $view->getPluginById('title');
				$plugin->isValid = false;
				
                $errorPlugin = $view->getPluginById('error_title');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Title is missing'));
              $ok = false;
            }
			
			if($data['urltitle'] == '') {
				
				$plugin = $this->view->getPluginById('urltitle');
				$plugin->isValid = false;
				
                $errorPlugin = $this->view->getPluginById('error_urltitle');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Short url Title is missing'));
                $ok = false;
            }
 
            if($data['teaser'] == '') {
             	
				$plugin = $this->view->getPluginById('teaser');
				$plugin->isValid = false;
				
                $errorPlugin = $this->view->getPluginById('error_teaser');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Teaser is missing'));
                $ok = false;
            }             
            if($data['content'] == '') {
             	
				$plugin = $this->view->getPluginById('content');
				$plugin->isValid = false;
				
                $errorPlugin = $this->view->getPluginById('error_content');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Content is missing'));
                $ok = false;
            } 
             
            if($data['__CATEGORIES__']['Cat'] == '') {
            	
				$plugin = $this->view->getPluginById('Cat');
				$plugin->isValid = false;
				
                $errorPlugin = $this->view->getPluginById('error_cat');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Category is missing'));
                $ok = false;
            } 
             
            if($data['__CATEGORIES__']['Topic'] == '') {
            	
				$plugin = $this->view->getPluginById('Topic');
				$plugin->isValid = false;
				
                $errorPlugin = $this->view->getPluginById('error_topic');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Topic is missing'));
                $ok = false;
            }  
			  	               
            if(isset($data['img']['name']) && $data['img']['size'] > 1500000){
            	
				$plugin = $this->view->getPluginById('img');
				$plugin->isValid = false;
                	
                $errorPlugin = $this->view->getPluginById('error_img');
                $errorPlugin->message = DataUtil::formatForDisplay($this->__('Image is too big alowed up to 1,5MB'));
                $ok = false;            
            
			}
		         
		    } 
			 
            if (!$ok){
            $messagePlugin = $this->view->getPluginById('message');
            $messagePlugin->message = DataUtil::formatForDisplay($this->__('Something is wrong'));
            return false; 	
            }

					
			
			$id = $this->id;		
            $item = $this->item;
			

			if(empty($id)){
			
		            $item = array_merge($item,$data);
		            
		           
		            if ($data['img']['error'] == 0){
			            $imgsettings = array(
			            'field'     => 'img',
			            'folder'    => 'Mediasharex',
			            'img'       => $data['img']
			            );
			          
			            $item['img'] = serialize(Mediasharex_ImageUtil::generateImage($imgsettings));           
		            }else {
			            $item['img'] = null;   
		            } 
		
		            
		            $date = new DateTime('now');
		            $item['publishdate'] = $date->format('Y-m-d H:i:s');
		            
		
		            $id = ModUtil::apiFunc('Mediasharex', 'user', 'create', $item);
		            if ($id === false) {
		            return new Zikula_Response_Ajax(array('result' => true,
   										  'close' => true,
                                          'id' => $id));
		            }
										
			}else{
					
		            //$oldimg = unserialize($item['img']);


		            if (($data['__CATEGORIES__']['Topic'] == '')) {
			        $data['__CATEGORIES__']['Topic'] =  (string)$item['__CATEGORIES__']['Topic']['id'];
		            } else {	
					//$data['__CATEGORIES__']['Topic'] = (string)$item['__CATEGORIES__']['Topic']['id'];	
		            }
					
		            if ($data['__CATEGORIES__']['Cat']  == '') {
					$data['__CATEGORIES__']['Cat'] =  (string)$item['__CATEGORIES__']['Cat']['id'];
		            }else {
		            	
		            }					
					
		            $save = array_merge($item, $data); 
				
					$save['img'] = $item['img']; 
				
					//var_dump($save);
					//exit(0);				
									
					$ok = ModUtil::apiFunc('Mediasharex', 'user', 'update', $save);
            		if ($ok === false) {
            		return false;
            		}						

            $messagePlugin = $this->view->getPluginById('message');
            $messagePlugin->message = DataUtil::formatForDisplay($this->__('Saved'));
           	$messagePlugin->cssClass = 'z-statusmsg' ; 
		    return true;  			
			}
          
		   	  
            
        } else if ($args['commandName'] == 'delete') {
            
            $ok = ModUtil::apiFunc('Mediasharex', 'user', 'delete', array('id' => $id));
            if ($ok === false) {
            return new Zikula_Response_Ajax(array('result' => $this->view->registerError(null),
   										  'close' => false,
                                          'id' => $id));
            }   
            $id = null;
            $url = ModUtil::url('Mediasharex', 'user');
        }
		
		
        return false;
    }
}