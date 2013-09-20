<?php
/**
 * Mediasharex
 *
 */
class Mediasharex_Handler_AddAlbum extends Zikula_Form_AbstractHandler
{
    private $album;
	private $parentalbum; 
	private $redirect;
	         
    public function initialize(Zikula_Form_View $view)
    {

		// Security check
		if(!Mediasharex_Util_Access::checkPerms(ACCESS_COMMENT, '::')){
       	throw new Zikula_Exception_Forbidden(LogUtil::getErrorMsgPermission());			
		}
		
		$access = new Mediasharex_Util_Access();
            
        $redirect   = FormUtil::getPassedValue('redirect', isset($args['redirect']) ? $args['redirect'] : null, 'GETPOST');		         
		$this->redirect = $redirect;   	
		
        $album_id   = FormUtil::getPassedValue('album', isset($args['album']) ? $args['album'] : null, 'GETPOST');		
		if ($album_id){
			// load album
			$parentalbumManager = new Mediasharex_Manager_Album($album_id);			
			$parentalbum = $parentalbumManager->getItemArray();
			// confirm add access
			$parentalbumaccess = $access->getAlbumAccess($parentalbum);	
			if(!$parentalbumaccess['add_album']){
	       	//throw new Zikula_Exception_Forbidden(LogUtil::getErrorMsgPermission());			
			}		
			$this->parentalbum = $album_id;
	        $view->assign('parentalbum', $album_id);				
		}else{			
			$user_album = ModUtil::apiFunc('Mediasharex', 'user', 'getUserAlbum');	
			if($user_album === false){		
			throw new Zikula_Exception_Forbidden(LogUtil::getErrorMsgPermission());				
			}			
			
			$parentalbumManager = new Mediasharex_Manager_Album(null,$user_album);			
			$parentalbum = $parentalbumManager->getItemArray();
			// confirm add access
			$parentalbumaccess = $access->getAlbumAccess($parentalbum);	
			if(!$parentalbumaccess['add_album']){
	       	//throw new Zikula_Exception_Forbidden(LogUtil::getErrorMsgPermission());			
			}		
			$this->parentalbum = $user_album['id'];
	        $view->assign('parentalbum', $user_album['id']);
			
		}		

		
	
		$view->assign('access_select',$access->getAccessSelect());		
		
		
		$tree = new Mediasharex_Util_AlbumTree();		
		//$root = $tree->getRoot();
		//$view->assign('root',$root);		
		//$tree_arr = $tree->getTree($album_id);
		$view->assign('bread',$tree->getPath($album_id));
		//$view->assign('a_fields',$tree->_getFields());
		//$bread = $tree->getBreadcrumbs($album_id); 		
		//$view->assign('bread',$bread);
		//$view->assign('a_node',$tree->deleteSingleNode(827));		
		
		$themes = Mediasharex_Util_AlbumThemes::getThemesSelect();
		$view->assign('themes_select',$themes);
		
		$albumManager = new Mediasharex_Manager_Album();
		$this->album = $albumManager->getItemArray();		             
	    $album = $this->album; 
		
		$album['parentalbum'] = $this->parentalbum;
		
		$album['access'] = $access->getAlbumAccess($album);
        $view->assign($album);
		$view->assign('album',$album);
		 
		$view->assign('subalbums',$albumManager->getSubAlbums());
		$view->assign('mediaitems',$albumManager->getMediaItems());
		//$view->assign('mainitem2',$albumManager->getMainmedia());		
		//redirect
        $view->assign('redirect', (isset($redirect) && !empty($redirect)) ? true : false);
        $view->assign('catreg', CategoryRegistryUtil::getRegisteredModuleCategories('Mediasharex', 'mediasharex_albums'));
		
 		$this->view->caching = Zikula_View::CACHE_DISABLED;
  
      return true;
    }


    public function handleCommand(Zikula_Form_View $view, &$args)
    {
    		
        
        if ($args['commandName'] == 'cancel') {
        	                
			//$data = $this->view->getValues();
            return $this->view->redirect($data['redirect']);
        }		
		

       if ($args['commandName'] == 'add') {


			$data = $this->view->getValues();		
			//$id = $this->id;                
            $album = $this->album;
				
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
		    $album = array_merge($album, $data);
			}else {
			$album = array_merge($album, $data);					
			}
		
			$albumManager = new Mediasharex_Manager_Album(false,$album);		
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
