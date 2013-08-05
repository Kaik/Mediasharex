<?php
/**
 * Mediasharex
 */

class Mediasharex_Controller_User extends Zikula_AbstractController
{
    const ACTION_PREVIEW = 0;

    /**
     */
    public function main($args)
    {
        return $this->home($args);
    }
    
    /**
	 * 
	 */
    public function view($args)
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_READ)) {
            return LogUtil::registerPermissionError();
        }


        // Get parameters from whatever input we need
        $album = $this->request->query->get('album',  isset($args['album']) ? $args['album'] : 1);
        $media   = $this->request->query->get('media',  isset($args['media']) ? $args['media'] : false);

		$album['template'] = 'standard';		
		
		if ($album){									
		$albumManager = new Mediasharex_Manager_Album($album);			
		$album = $albumManager->getItemArray();				
	    $this->view->assign('album',     $album);
		$this->view->assign('subalbums',$albumManager->getSubAlbums());
		$this->view->assign('mediaitems',$albumManager->getMediaItems());
		//$this->view->assign('mainitem2',$albumManager->getMainmedia());		
		//redirect				
		$template = 'user/themes/'.$album['template'].'/album.tpl';
				
		if ($media){		
		$mediaManager = new Mediasharex_Manager_MediaItem($media);
		$mediaitem = $mediaManager->getItemArray();			
	    $this->view->assign('mediaitem',     $mediaitem);	
		$template = 'user/themes/'.$album['template'].'/mediaitem.tpl';		
		
		}else{
		$mediaManager = new Mediasharex_Manager_MediaItem($media);
		$mediaitem = $mediaManager->getItemArray();			
	    $this->view->assign('mediaitem',     $mediaitem);			
		}			
		}elseif ($media){
		$mediaManager = new Mediasharex_Manager_MediaItem($media);
		$mediaitem = $mediaManager->getItemArray();			
	    $this->view->assign('mediaitem',     $mediaitem);			
		
		$albumManager = new Mediasharex_Manager_Album($mediaitem['parentalbum']);
		$album = $albumManager->getItemArray();				
	    $this->view->assign('album',     $album);
		
		$template = 'user/themes/'.$album['template'].'/mediaitem.tpl';			
					

		}

		//$this->view->assign(ModUtil::apiFunc('Mediasharex', 'user', 'getAlbumCats'));				

		//$this->view->assign(ModUtil::apiFunc('Mediasharex', 'user', 'getMediaCats'));			
	    $this->view->assign(ModUtil::apiFunc('Mediasharex', 'user', 'getAccess'));
		// assign the module vars
        $this->view->assign(ModUtil::getVar('Mediasharex'));

        // Return the output
        return $this->view->fetch($template);
		
    }

    /**
     */
    public function home($args)
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_READ)) {
            return LogUtil::registerPermissionError();
        }

		$mediaManager = new Mediasharex_Manager_MediaItems();
		$mediaManager->setOrderby('cr_date','DESC');
		$mediaManager->setItems(7);
		$this->view->assign('new_items',$mediaManager->getAll());

		$mediaManager2 = new Mediasharex_Manager_MediaItems();
		$mediaManager2->setOrderby('hitcount','DESC');
		$mediaManager2->setItems(3);
		$this->view->assign('popular_items',$mediaManager2->getAll());

        // Return the output
        return $this->view->fetch('user/home.tpl');
    }





    /**
     */
    public function display($args)
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_READ)) {
            return LogUtil::registerPermissionError();
        }

        $previewsManager = new Mediasharex_Manager_Previews();
		$previews = $previewsManager->getPreviews();
		$this->view->assign('previews', $previews);        
        
		$def_preview = $previewsManager->getDefault();                
        // Get parameters from whatever input we need
        $album = $this->request->query->get('album',  isset($args['album']) ? $args['album'] : 1);
        $media   = $this->request->query->get('media',  isset($args['media']) ? $args['media'] : false);
        $preview   = $this->request->query->get('preview',  isset($args['preview']) ? $args['preview'] : $def_preview['name']);


	    $this->view->assign('c_preview',  $preview);
		$this->view->assign('c_preview_data',  $previews[$preview]);


		//$previewsManager = new Mediasharex_Manager_Previews();			
		//$previews = $previewsManager->getPreviews();
	    //$this->view->assign('previews', $previews);
        //$preview   = $this->request->query->get('media',  isset($args['media']) ? $args['media'] : false);
	
		
		if ($album){									
		$albumManager = new Mediasharex_Manager_Album($album);			
		$album = $albumManager->getItemArray();				
	    $this->view->assign('album',     $album);
		$this->view->assign('subalbums',$albumManager->getSubAlbums());
		$this->view->assign('mediaitems',$albumManager->getMediaItems());
		//$this->view->assign('mainitem2',$albumManager->getMainmedia());		
		//redirect
						
		$template = 'user/themes/'.$album['template'].'/album/album.tpl';
				
		if ($media){		
		$mediaManager = new Mediasharex_Manager_MediaItem($media);
		$mediaitem = $mediaManager->getItemArray();			
	    $this->view->assign('mediaitem',     $mediaitem);	
		$template = 'user/themes/'.$album['template'].'/media/mediaitem.tpl';		
		
		}else{
		$mediaManager = new Mediasharex_Manager_MediaItem($media);
		$mediaitem = $mediaManager->getItemArray();			
	    $this->view->assign('mediaitem',     $mediaitem);			
		}			
		}elseif ($media){
		$mediaManager = new Mediasharex_Manager_MediaItem($media);
		$mediaitem = $mediaManager->getItemArray();			
	    $this->view->assign('mediaitem',     $mediaitem);			
		
		$albumManager = new Mediasharex_Manager_Album($mediaitem['parentalbum']);
		$album = $albumManager->getItemArray();				
	    $this->view->assign('album',     $album);
		
		$template = 'user/themes/'.$album['template'].'/media/mediaitem.tpl';			
					

		}

		//$this->view->assign(ModUtil::apiFunc('Mediasharex', 'user', 'getAlbumCats'));				

		//$this->view->assign(ModUtil::apiFunc('Mediasharex', 'user', 'getMediaCats'));			
	    $this->view->assign(ModUtil::apiFunc('Mediasharex', 'user', 'getAccess'));
		// assign the module vars
        $this->view->assign(ModUtil::getVar('Mediasharex'));

        // Return the output
        return $this->view->fetch($template);
    }


    /**
     */
    public function add_media($args)
    {		
        // Create Form output object
        $render = FormUtil::newForm('Mediasharex', $this);

        // Return the output that has been generated by this function
        return $render->execute("user/media/add_media.tpl", new Mediasharex_Handler_AddMedia());
    }
	
    /**
     *
     */
	public function modify_media($args)
    {		
        // Create Form output object
        $render = FormUtil::newForm('Mediasharex', $this);

        // Return the output that has been generated by this function
        return $render->execute("user/media/modify_media.tpl", new Mediasharex_Handler_ModifyMediaItem());
    
	}	
	

    /**
     *
     */
    public function add_album($args)
    {		
        // Create Form output object
        $render = FormUtil::newForm('Mediasharex', $this);

        // Return the output that has been generated by this function
        return $render->execute("user/album/add_album.tpl", new Mediasharex_Handler_ModifyAlbum());
    }
    /**
     *
     */
	public function modify_album($args)
    {		
        // Create Form output object
        $render = FormUtil::newForm('Mediasharex', $this);

        // Return the output that has been generated by this function
        return $render->execute("user/album/modify_album.tpl", new Mediasharex_Handler_ModifyAlbum());
    
	}



		
}
