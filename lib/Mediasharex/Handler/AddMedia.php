<?php
/**
 * Mediasharex
 *
 */
class Mediasharex_Handler_AddMedia extends Zikula_Form_AbstractHandler
{
	
	private $source;
	private $medias;
	private $parentalbum; 
 
         
    public function initialize(Zikula_Form_View $view)
    {
		// Security check
		if(!Mediasharex_Util_Access::checkPerms(ACCESS_COMMENT, '::')){
       	throw new Zikula_Exception_Forbidden(LogUtil::getErrorMsgPermission());			
		}
     
        $source   = FormUtil::getPassedValue('source', isset($args['source']) ? $args['source'] : null, 'GETPOST');         
		$this->source = $source;
        $redirect   = FormUtil::getPassedValue('redirect', isset($args['redirect']) ? $args['redirect'] : null, 'GETPOST');         

		$access = new Mediasharex_Util_Access();

        $album_id   = FormUtil::getPassedValue('album', isset($args['album']) ? $args['album'] : false, 'GETPOST');         
		if ($album_id){
		// load parent album
		$albumManager = new Mediasharex_Manager_Album($album_id);			
		$album = $albumManager->getItemArray();
		// confirm add access
		$album_access = $access->getAlbumAccess($album);	
		if(!$album_access['add_media']){
       	throw new Zikula_Exception_Forbidden(LogUtil::getErrorMsgPermission());			
		}		
		$this->parentalbum = $album_id;
        $view->assign('parentalbum', $album_id);				
		}elseif (ModUtil::getVar('Mediasharex','album_enableUserAlbum',false)){			
		//no parent passed first get user album option
		
		//				
		}elseif (ModUtil::getVar('Mediasharex','album_defaultNewMediaAlbum',false)){
		//get default album 	
			
			
		}else{
		//get accessible albums and make a select			
		// redirect with no album error		
							
		}
		
          
        $view->caching = false;

		$sourcesManager = new Mediasharex_Manager_MediaSources();	 
		$sources = $sourcesManager->getAll();									
        $view->assign('sources', $sources);			
				
		$access_select = $access->getAccessSelect();		
		$view->assign('access_select',$access_select);	

		$view->assign('isPostBack',$view->isPostBack());	
				
		//redirect
        $view->assign('redirect', (isset($redirect) && !empty($redirect)) ? true : false);
		
		if(ModUtil::getVar('Mediasharex','media_enableCategories',false)){		
        $view->assign('catreg', CategoryRegistryUtil::getRegisteredModuleCategories('Mediasharex', 'mediasharex_media'));
        }
  
      return true;

		
    }


    public function handleCommand(Zikula_Form_View $view, &$args)
    {
    	  
        if ($args['commandName'] == 'cancel') {                


        }

		if ($args['commandName'] == 'check') {
				
		$data = $this->view->getValues();		

		//source
		$pre_media = array();					
		if (is_array($data)){
		foreach	($data as $source_name => $upload_data){
		if ($upload_data){	
			$source['name'] = $source_name;
			$sourceManager = new Mediasharex_Manager_MediaSource(null,$source);	 
			$pre_media = array_merge($pre_media, $sourceManager->readPost($upload_data));
		}		
		}		
		}
		//handler
		$handled_media = array();		
		if (is_array($pre_media)){
		foreach	($pre_media as $key => $pre_media_data){
		if ($pre_media_data){	
			//$source['name'] = $source_name;
			//$sourceManager = new Mediasharex_Manager_MediaSource(null,$source);	 
			//$media[] = //array_merge($media, $sourceManager->readPost($upload_data));

		}		
		}		
		}
		//pre_copy in tmp/mediashare/refname
		$pre_saved_media = array();
		if (is_array($pre_media)){
		foreach	($pre_media as $key => $pre_media_data){
		if ($pre_media_data){	
			//$source['name'] = $source_name;
			//$sourceManager = new Mediasharex_Manager_MediaSource(null,$source);	 
			//$media[] = //array_merge($media, $sourceManager->readPost($upload_data));

		}		
		}		
		}






	
		//assign output
        $view->assign('media', $pre_media);
        return true;
		}
 

		if ($args['commandName'] == 'save') {
				
		$data = $this->view->getValues();		


		echo "<pre>";	
	   	var_dump($data);
		exit(0);			
		

		//saved media






		//validation		
        $ok = true; 

		$post_data['pre_media'] = $data;
        $view->assign('post_data', $post_data);


		
		// title description all media item data
		
		if(ModUtil::getVar('Mediasharex','media_enableCategories',false)){	
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
		}	
			
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
			/*			
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
			*/

            if (!$ok){
            				           
            return false;				
            }
			
		$item = $data;	
			
		$mediaManager = new Mediasharex_Manager_MediaItem(false,$item);	
			
		$originalPreview = $mediaManager->setOriginalPreview($item);
		
		if(!$originalPreview){
		LogUtil::registerStatus($this->__('Error occured original preview not saved'));		
		return false;		
		}		

		$newMedia = $mediaManager->save();
		
		if(!$newMedia){
		LogUtil::registerStatus($this->__('Error occured new media not saved'));		
		return false;		
		}
		
		$previewManager = new Mediasharex_Manager_MediaStoreItem($newMedia['original']); 
		$orginal_preview = $previewManager->getItem();
		$orginal_preview->setMediaitem($newMedia['id']);
		$savecomplete = $previewManager->save();

		if(!$savecomplete){
		LogUtil::registerStatus($this->__('Error occured media preview not updated'));		
		return false;		
		}
		

	
		$redirecturl = ModUtil::url('Mediasharex','user','display',array('media' => $newMedia['id']));
	
		return $view->redirect($redirecturl);

		}

    }
}


		/*
        $view->assign('post_data', $pre_data);

	
		$plugin = $this->view->getPluginById('title');
		$plugin->text = $pre_data['pre_media']['title'];
		
		$plugin = $this->view->getPluginById('description');
		$plugin->text = $pre_data['pre_media']['description'];
				
		$plugin = $this->view->getPluginById('previewname');
		$plugin->text = $pre_data['pre_media']['previewname'];
		
		$plugin = $this->view->getPluginById('mimetype');
		$plugin->text = $pre_data['pre_media']['mimetype'];	

		$plugin = $this->view->getPluginById('fileref');
		$plugin->text = $pre_data['pre_media']['fileref'];

		$plugin = $this->view->getPluginById('width');
		$plugin->text = $pre_data['pre_media']['width'];	
		
		$plugin = $this->view->getPluginById('height');
		$plugin->text = $pre_data['pre_media']['height'];	

		$plugin = $this->view->getPluginById('bytes');
		$plugin->text = $pre_data['pre_media']['size'];		

		$plugin = $this->view->getPluginById('parentalbum');
		$plugin->text = $this->parentalbum;			
		
		$plugin = $this->view->getPluginById('handler');
		$plugin->text = $pre_data['pre_media']['handler'];							
		*/
		
				//echo "<pre>";	
	   	//var_dump($data);
		//exit(0);		
		