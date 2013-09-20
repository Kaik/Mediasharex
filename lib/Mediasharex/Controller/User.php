<?php
/**
 * Mediasharex
 */

class Mediasharex_Controller_User extends Zikula_AbstractController
{


    /**
     */
    public function main($args)
    {
    	$startPage = $this->getVar('general_startPage','home');
		
        return $this->$startPage($args);
    }
    /**
     */
    public function home($args)
    {
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_READ, '::'));

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
	 * 
	 */
    public function view($args)
    {
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_READ, '::'));

		// Previews
        $previewsManager = new Mediasharex_Manager_Previews();
		$previews = $previewsManager->getPreviews();
		$this->view->assign('previews', $previews);                
		$def_preview = $previewsManager->getDefault(); 
        $preview   = $this->request->query->get('preview',  isset($args['preview']) ? $args['preview'] : $def_preview['name']);
	    $this->view->assign('c_preview',  $preview);
		$this->view->assign('c_preview_data',  $previews[$preview]);

		// Load standard theme 
		$def_albumTheme = $this->getVar('albums_defaultTheme','standard');
		$this->view->assign('def_albumTheme', $def_albumTheme); 
        
		// Basic list input 
        $page 		= $this->request->query->get('page',  isset($args['page']) ? $args['page'] : 1);
        $orderby   	= $this->request->query->get('orderby',  isset($args['orderby']) ? $args['orderby'] : 'cr_date');
        $order   	= $this->request->query->get('order',  isset($args['order']) ? $args['order'] : 'DESC');
        $items   	= $this->request->query->get('items',  isset($args['items']) ? $args['items'] : 25);

		// Specific conditions
        $author 	= $this->request->query->get('author',  isset($args['author']) ? $args['author'] : -1);


		$mediaManager = new Mediasharex_Manager_MediaItems();
		$mediaManager->setAuthor($author);		
		$mediaManager->setPage($page);		
		$mediaManager->setOrderby($orderby,$order);
		$mediaManager->setItems($items);	
		$mediaitems_array = $mediaManager->getAll();		
		$pager = $mediaManager->getPager();						

        // Assign all and pager
        $this->view->assign('media',$mediaitems_array)
				   ->assign('pager',$pager);

        // Assign basic input
		$this->view->assign('page', 	$page);
		$this->view->assign('orderby', 	$orderby);
		$this->view->assign('order', 	$order);
		$this->view->assign('items', 	$items);
		
		
        // Assign specific conditions
		$this->view->assign('author', $author);
		

        // Return the output
        return $this->view->fetch('user/browse.tpl');
		
    }


    /**
     */
    public function display($args)
    {
				
    	
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_READ, '::'));
		
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
		$access = new Mediasharex_Util_Access();
		$album['access'] = $access->getAlbumAccess($album);			
	    $this->view->assign('album',     $album);
		$this->view->assign('subalbums',$albumManager->getSubAlbums());
		$this->view->assign('mediaitems',$albumManager->getMediaItems());
		$tree = new Mediasharex_Util_AlbumTree();		
		$bread = $tree->getPath($album['id']); 		
		$this->view->assign('bread',$bread);		
		
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
    public function my_album($args)
    {
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_READ, '::'));
		
		$user_album = ModUtil::apiFunc('Mediasharex', 'user', 'getUserAlbum');

		if($user_album === false){		
		$c_uid = UserUtil::getVar('uid');	
		$this->redirect(ModUtil::url($this->name, 'user', 'view',array('author' => $c_uid)));			
		}	

		if($user_album === null){		
			
		}

		//var_dump($user_album);
		//exit(0);	
		
		$albumManager = new Mediasharex_Manager_Album(null,$user_album);			
		$album = $albumManager->getItemArray();
		$access = new Mediasharex_Util_Access();
		$album['access'] = $access->getAlbumAccess($album);								
	    $this->view->assign('album',     $album);
		$this->view->assign('subalbums',$albumManager->getSubAlbums());
		$this->view->assign('mediaitems',$albumManager->getMediaItems());		
				
		
		$template = 'user/themes/'.$album['template'].'/album/album.tpl';

        // Previews
        $previewsManager = new Mediasharex_Manager_Previews();
		$previews = $previewsManager->getPreviews();
		$this->view->assign('previews', $previews);              
		$def_preview = $previewsManager->getDefault();                
        $preview   = $this->request->query->get('preview',  isset($args['preview']) ? $args['preview'] : $def_preview['name']);
	    $this->view->assign('c_preview',  $preview);
		$this->view->assign('c_preview_data',  $previews[$preview]);

		
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
        return $render->execute("user/album/add_album.tpl", new Mediasharex_Handler_AddAlbum());
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
