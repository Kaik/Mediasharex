<?php
/**
 * Mediasharex
 */

/**
 * Administrator-initiated actions for the Mediasharex module.
 */
class Mediasharex_Controller_Admin extends Zikula_AbstractController
{
    /**
     */
    public function main()
    {
        $this->redirect(ModUtil::url($this->name, 'admin', 'info'));
    }
	
	
    /**
     */
    public function info()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }

		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$infolinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getInfoLinks');
		$this->view->assign('infolinks', $infolinks);		
		
		$dir_check['mediaDirName']['writable'] = ModUtil::apiFunc('Mediasharex', 'admin', 'mediashareDirIsWritable',$modulevars['mediaDirName']);
		$dir_check['tmpDirName']['writable']   = ModUtil::apiFunc('Mediasharex', 'admin', 'mediashareDirIsWritable',$modulevars['tmpDirName']);		
        $this->view->assign('dir_check', $dir_check);

		//Get albums		
		$albumsManager = new Mediasharex_Manager_Albums();
		$albums = $albumsManager->getCount();
		$this->view->assign('albums',$albums);
		//Get media		
		$mediaManager = new Mediasharex_Manager_MediaItems();
		$media = $mediaManager->getCount();
		$this->view->assign('media',$media);
		//Get handlers		
		$handlersManager = new Mediasharex_Manager_MediaHandlers();
		$mediahandlers = $handlersManager->getCount();
		$this->view->assign('mediahandlers',$mediahandlers);
		//Get sources		
		$sourcesManager = new Mediasharex_Manager_MediaSources();
		$sources = $sourcesManager->getCount();		
		$this->view->assign('sources',$sources);
		
        // Assign all the module vars
        return $this->view->fetch('admin/info/status.tpl');
    }	

    /**
     */
    public function info_docs()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }

       $langtype   = $this->request->query->get('langtype',  isset($args['langtype']) ? $args['langtype'] : 'en');
       $dirtype   = $this->request->query->get('dirtype',  isset($args['dirtype']) ? $args['dirtype'] : 'admin');
       $file_name   = $this->request->query->get('file_name',  isset($args['file_name']) ? $args['file_name'] : '1_introduction.rst');
		
		
		$file_path = 'modules/Mediasharex/docs/'.$langtype.'/'.$dirtype.'/'.$file_name;

		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);

		$docslinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getDocsLinks');
		$this->view->assign('docslinks', $docslinks);
		//$docs = ModUtil::apiFunc('Mediasharex', 'admin', 'getDocs');
		//$this->view->assign('docs', $docs);
		
		//Get users module settings
		$infolinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getInfoLinks');
		$this->view->assign('infolinks', $infolinks);		
		//;

		
		$file_content = Mediasharex_Util_RstFile::readFile($file_path);
		$this->view->assign('file_content',$file_content);
		$this->view->assign('file_path',$file_path);		
        // Assign all the module vars
        return $this->view->fetch('admin/info/file_view.tpl');
    }
	

	
	
    /**
     */
    public function info_modify_file()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
        // Confirm the forms authorisation key
        //$this->checkCsrfToken();

		$file_path = $this->request->getPost()->get('file_path');		
		$this->view->assign('file_path',$file_path);
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$infolinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getInfoLinks');
		$this->view->assign('infolinks', $infolinks);		


		$file_content = Mediasharex_Util_RstFile::getFile($file_path);
		$this->view->assign('file_content',$file_content);
		
        // Assign all the module vars
        return $this->view->fetch('admin/info/modify_file.tpl');
    }	

    /**
     */
    public function info_save_file()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$file_path = $this->request->getPost()->get('file_path');		
		$this->view->assign('file_path',$file_path);
		$file_content = $this->request->getPost()->get('file_content');	
		
			
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$infolinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getInfoLinks');
		$this->view->assign('infolinks', $infolinks);		

		$ok = Mediasharex_Util_RstFile::saveFile($file_path,$file_content);
		$this->view->assign('ok',$ok);
		
		$file_contentn = Mediasharex_Util_RstFile::getFile($file_path);
		$this->view->assign('file_content',$file_contentn);
		
        // Assign all the module vars
        return $this->view->fetch('admin/info/modify_file.tpl');
    }

    /**
     */
    public function settings_general()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$settingslinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSettingsLinks');
		$this->view->assign('settingslinks', $settingslinks);	

		
        // Assign all the module vars
        return $this->view->fetch('admin/settings/general.tpl');
    }

    /**
   */
    public function settings_general_update()
    {
        // Security check
        if (!SecurityUtil::checkPermission($this->name . '::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }

        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$modulevars = $this->request->getPost()->get('modulevars');

		if (is_array($modulevars)){
		foreach ($modulevars as $optionname => $value) {
			 if ($optionname !== 'activate'){	
			 $this->setVar($optionname, $value);	
			 }
		 }				
		}				
		
        // the module configuration has been updated successfuly
        $this->registerStatus($this->__('Done! Saved module configuration.'));

        // This function generated no output, and so now it is complete we redirect
        // the user to an appropriate page for them to carry on their work
        $this->redirect(ModUtil::url($this->name, 'admin', 'settings_general'));
    }
    /**
     */
    public function settings_display()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);

		$previewsManager = new Mediasharex_Manager_Previews();
		$this->view->assign('previews', $previewsManager->getPreviews());


		
		//Get users module settings
		$settingslinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSettingsLinks');
		$this->view->assign('settingslinks', $settingslinks);		
		
        // Assign all the module vars
        return $this->view->fetch('admin/settings/display.tpl');
    }

    /**
   */
    public function settings_display_update()
    {
        // Security check
        if (!SecurityUtil::checkPermission($this->name . '::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }

        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$previews = $this->request->getPost()->get('previews', false);

		foreach ($previews as $preview_name => $preview_data){
		  	if ($preview_data['remove']){
			unset($preview_data['remove']);		
			unset($previews[$preview_name]);	
		  	}else{						
			$update_preview_name = $preview_data['name'];
			unset($preview_data['name']);	
			$update_preview = $preview_data;	
			unset($previews[$preview_name]);
			$previews[$update_preview_name] = $update_preview;								
			}
		}	

		$new_preview = $this->request->getPost()->get('new_preview', false);

		if ($new_preview['name'] !== ''){
		$new_preview_name = $new_preview['name'];
		unset($new_preview['name']);	
		$previews[$new_preview_name] = $new_preview;	
		}

		//var_dump($previews);
		//exit();		




		$previewsManager = new Mediasharex_Manager_Previews();
		$previewsManager->setPreviews($previews);
		$saved = $previewsManager->savePreviews();

	
		if($saved){
        // the module configuration has been updated successfuly
        $this->registerStatus($this->__('Done! Saved module configuration.'));			
		}else{
        // the module configuration has been updated successfuly
        $this->registerError($this->__('Update failed'));				
		}		

        // This function generated no output, and so now it is complete we redirect
        // the user to an appropriate page for them to carry on their work
        $this->redirect(ModUtil::url($this->name, 'admin', 'settings_display'));
    }

    /**
     */
    public function settings_albums()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		

		
		
		//Get users module settings
		$settingslinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSettingsLinks');
		$this->view->assign('settingslinks', $settingslinks);		
		
        // Assign all the module vars
        return $this->view->fetch('admin/settings/albums.tpl');
    }

    /**
   */
    public function settings_albums_update()
    {
        // Security check
        if (!SecurityUtil::checkPermission($this->name . '::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }

		$enablealbumattributies = $this->request->getPost()->get('enablealbumattributies', true);
		$this->setVar('enablealbumattributies', $enablealbumattributies);					
		
        // the module configuration has been updated successfuly
        $this->registerStatus($this->__('Done! Saved module configuration.'));

        // This function generated no output, and so now it is complete we redirect
        // the user to an appropriate page for them to carry on their work
        $this->redirect(ModUtil::url($this->name, 'admin', 'settings_albums'));
    }

    /**
     */
    public function settings_media()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$settingslinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSettingsLinks');
		$this->view->assign('settingslinks', $settingslinks);		

		
        // Assign all the module vars
        return $this->view->fetch('admin/settings/media.tpl');
    }

    /**
   */
    public function settings_media_update()
    {
        // Security check
        if (!SecurityUtil::checkPermission($this->name . '::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }

        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$modulevars = $this->request->getPost()->get('modulevars');

		if (is_array($modulevars)){
		foreach ($modulevars as $optionname => $value) {
			 if ($optionname !== 'activate'){	
			 $this->setVar($optionname, $value);	
			 }
		 }				
		}				
		
        // the module configuration has been updated successfuly
        $this->registerStatus($this->__('Done! Saved module configuration.'));

        // This function generated no output, and so now it is complete we redirect
        // the user to an appropriate page for them to carry on their work
        $this->redirect(ModUtil::url($this->name, 'admin', 'settings_media'));
    }


    /**
     */
    public function settings_storage()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$settingslinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSettingsLinks');
		$this->view->assign('settingslinks', $settingslinks);		

		
        // Assign all the module vars
        return $this->view->fetch('admin/settings/storage.tpl');
    }
    /**
   */
    public function settings_storage_update()
    {
        // Security check
        if (!SecurityUtil::checkPermission($this->name . '::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }

        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$modulevars = $this->request->getPost()->get('modulevars');

		if (is_array($modulevars)){
		foreach ($modulevars as $optionname => $value) {
			 if ($optionname !== 'activate'){	
			 $this->setVar($optionname, $value);	
			 }
		 }				
		}				
		
        // the module configuration has been updated successfuly
        $this->registerStatus($this->__('Done! Saved module configuration.'));

        // This function generated no output, and so now it is complete we redirect
        // the user to an appropriate page for them to carry on their work
        $this->redirect(ModUtil::url($this->name, 'admin', 'settings_storage'));
    }


    /**
     */
    public function settings_sources()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$settingslinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSettingsLinks');
		$this->view->assign('settingslinks', $settingslinks);		
		
        // Assign all the module vars
        return $this->view->fetch('admin/settings/sources.tpl');
    }
    /**
   */
    public function settings_sources_update()
    {
        // Security check
        if (!SecurityUtil::checkPermission($this->name . '::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }

        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$modulevars = $this->request->getPost()->get('modulevars');

		if (is_array($modulevars)){
		foreach ($modulevars as $optionname => $value) {
			 if ($optionname !== 'activate'){	
			 $this->setVar($optionname, $value);	
			 }
		 }				
		}				
		
        // the module configuration has been updated successfuly
        $this->registerStatus($this->__('Done! Saved module configuration.'));

        // This function generated no output, and so now it is complete we redirect
        // the user to an appropriate page for them to carry on their work
        $this->redirect(ModUtil::url($this->name, 'admin', 'settings_sources'));
    }

    /**
     */
    public function settings_handlers()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$settingslinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSettingsLinks');
		$this->view->assign('settingslinks', $settingslinks);		


		
        // Assign all the module vars
        return $this->view->fetch('admin/settings/handlers.tpl');
    }
    /**
   */
    public function settings_handlers_update()
    {
        // Security check
        if (!SecurityUtil::checkPermission($this->name . '::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }

        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$modulevars = $this->request->getPost()->get('modulevars');

		if (is_array($modulevars)){
		foreach ($modulevars as $optionname => $value) {
			 if ($optionname !== 'activate'){	
			 $this->setVar($optionname, $value);	
			 }
		 }				
		}				
		
        // the module configuration has been updated successfuly
        $this->registerStatus($this->__('Done! Saved module configuration.'));

        // This function generated no output, and so now it is complete we redirect
        // the user to an appropriate page for them to carry on their work
        $this->redirect(ModUtil::url($this->name, 'admin', 'settings_handlers'));
    }

    /**
     */
    public function settings_import()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$settingslinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSettingsLinks');
		$this->view->assign('settingslinks', $settingslinks);		

		
        // Assign all the module vars
        return $this->view->fetch('admin/settings/import.tpl');
    }
    /**
   */
    public function settings_import_update()
    {
        // Security check
        if (!SecurityUtil::checkPermission($this->name . '::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }

        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$modulevars = $this->request->getPost()->get('modulevars');

		if (is_array($modulevars)){
		foreach ($modulevars as $optionname => $value) {
			 if ($optionname !== 'activate'){	
			 $this->setVar($optionname, $value);	
			 }
		 }				
		}				
		
        // the module configuration has been updated successfuly
        $this->registerStatus($this->__('Done! Saved module configuration.'));

        // This function generated no output, and so now it is complete we redirect
        // the user to an appropriate page for them to carry on their work
        $this->redirect(ModUtil::url($this->name, 'admin', 'settings_import'));
    }


    /**
     */
    public function manager()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		//Get users module settings
		$managerlinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getManagerLinks');
		$this->view->assign('managerlinks', $managerlinks);		

		
        // Assign all the module vars
        return $this->view->fetch('admin/manager/manager.tpl');
    }


    /**
     */
    public function manager_albums()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$managerlinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getManagerLinks');
		$this->view->assign('managerlinks', $managerlinks);		

        $page   = $this->request->query->get('page',  isset($args['page']) ? $args['page'] : 1);


		//Get albums		
		$albums = new Mediasharex_Manager_Albums();
		$albums->setPage($page);		
		$albums->setOrderby('parentalbum','ASC');
		$albums_array = $albums->getAll();
		$pager = $albums->getPager();		
		
		
        $this->view->assign('albums',$albums_array)
						  ->assign('pager',$pager);	

		
        // Assign all the module vars
        return $this->view->fetch('admin/manager/albums.tpl');   
		
	 }
	    /**
     */
	public function manager_modify_album($args)
    {		
        // Create Form output object
        $render = FormUtil::newForm('Mediasharex', $this);

        // Return the output that has been generated by this function
        return $render->execute("admin/manager/modify/album.tpl", new Mediasharex_Handler_ModifyAlbum());
    
	}

    /**
     */
    public function manager_media()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$managerlinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getManagerLinks');
		$this->view->assign('managerlinks', $managerlinks);		

        $page   = $this->request->query->get('page',  isset($args['page']) ? $args['page'] : 1);	
		
		$MediaItems = new Mediasharex_Manager_MediaItems();
		$MediaItems->setPage($page);		
		$MediaItems->setOrderby('parentalbum','ASC');
		$mediaitems_array = $MediaItems->getAll();
		$pager = $MediaItems->getPager();		
		
		//$new_item2 = $itemManager->getItem();		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
				
        // Assign all the module vars
        $this->view->assign('items',$mediaitems_array)
						  ->assign('pager',$pager);	
		
        // Assign all the module vars
        return $this->view->fetch('admin/manager/media.tpl');
    }

    /**
     */
	public function manager_modify_media($args)
    {		
        // Create Form output object
        $render = FormUtil::newForm('Mediasharex', $this);

        // Return the output that has been generated by this function
        return $render->execute("admin/manager/modify/media.tpl", new Mediasharex_Handler_ModifyMediaItem());
    
	}

    /**
     */
    public function manager_previews()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$managerlinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getManagerLinks');
		$this->view->assign('managerlinks', $managerlinks);		

        $page   = $this->request->query->get('page',  isset($args['page']) ? $args['page'] : 1);


		$MediaStore = new Mediasharex_Manager_MediaStore();
		$MediaStore->setPage($page);
		$MediaStore->setOrderby('id','ASC');
		$MediaStore_array = $MediaStore->getAll();
		$pager = $MediaStore->getPager();				
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
				
        // Assign all the module vars
        $this->view->assign('mediastore',$MediaStore_array)
						  ->assign('pager',$pager);
		
        // Assign all the module vars
        return $this->view->fetch('admin/manager/previews.tpl');
    }

	/**
    */
	public function manager_modify_preview($args)
    {		
        // Create Form output object
        $render = FormUtil::newForm('Mediasharex', $this);

        // Return the output that has been generated by this function
        return $render->execute("admin/manager/modify/preview.tpl", new Mediasharex_Handler_ModifyStoreItem());
    
	}

	    /**
     */
    public function manager_invitations()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
 
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$managerlinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getManagerLinks');
		$this->view->assign('managerlinks', $managerlinks);		

        
        $page   = $this->request->query->get('page',  isset($args['page']) ? $args['page'] : 1);		
		
		
		$Invitations = new Mediasharex_Manager_Invitations();
		$Invitations->setPage($page);
		$Invitations->setOrderby('id','ASC');
		$Invitations_array = $Invitations->getAll();
		$pager = $Invitations->getPager();		
		
				
        // Assign all the module vars
        return $this->view->assign('Invitations',$Invitations_array)
						  ->assign('pager',$pager)		
            			  ->fetch('admin/manager/invitations.tpl');
    }	



	    /**
    */
	public function manager_modify_invitation($args)
    {		
        // Create Form output object
        $render = FormUtil::newForm('Mediasharex', $this);

        // Return the output that has been generated by this function
        return $render->execute("admin/manager/modify/invitation.tpl", new Mediasharex_Handler_ModifyInvitation());
    
	}

    /**
     */
    public function sandh()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$sandhlinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSandHLinks');
		$this->view->assign('sandhlinks', $sandhlinks);		
				
        // Assign all the module vars
        return $this->view->fetch('admin/sandh/sandh.tpl');
    }

    /**
     */
    public function sandh_handlers()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$sandhlinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSandHLinks');
		$this->view->assign('sandhlinks', $sandhlinks);		
		

        $page   = $this->request->query->get('page',  isset($args['page']) ? $args['page'] : 1);		
		
		$mediaHandlers = new Mediasharex_Manager_MediaHandlers();
		$mediaHandlers->setPage($page);
		$mediaHandlers->setOrderby('id','ASC');
		$mediaHandlers_array = $mediaHandlers->getAll();
		$pager = $mediaHandlers->getPager();		
		
		$files = $mediaHandlers->getHandlersDir();
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
				
        // Assign all the module vars
        $this->view->assign('mediaHandlers',$mediaHandlers_array)
						  ->assign('pager',$pager)
						  ->assign('files',$files);	
		
        // Assign all the module vars
        return $this->view->fetch('admin/sandh/handlers.tpl');
    }
	
	    /**
     */
	public function sandh_modify_handler($args)
    {		
        // Create Form output object
        $render = FormUtil::newForm('Mediasharex', $this);

        // Return the output that has been generated by this function
        return $render->execute("admin/sandh/modify/handler.tpl", new Mediasharex_Handler_ModifyHandler());
    
	}	


    /**
    */
    public function sandh_reload_handlers()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		
		$mediaHandlers = new Mediasharex_Manager_MediaHandlers();				
		$status = $mediaHandlers->reloadHandlers();
				
		if ($status) {			
        $this->registerStatus($this->__('Done database is actual now.'));				
		}else{			
        // the module configuration has been updated successfuly
        $this->registerError($this->__('Something went wrong check handlers storage.'));			
		}				
				
						
        // Assign all the module vars
        return $this->managehandlers();
    }
	
	
	    /**
     */
    public function sandh_sources()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$sandhlinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSandHLinks');
		$this->view->assign('sandhlinks', $sandhlinks);	

        $page   = $this->request->query->get('page',  isset($args['page']) ? $args['page'] : -1);		
		
		
		$mediaSources = new Mediasharex_Manager_MediaSources();
		$mediaSources->setPage($page);
		$mediaSources->setOrderby('id','ASC');
		$mediaSources_array = $mediaSources->getAll();
		$pager = $mediaSources->getPager();		
		
		$files = $mediaSources->getSourcesDir();
		
				
        // Assign all the module vars
        $this->view->assign('mediaSources',$mediaSources_array)
						  ->assign('pager',$pager)	
						  ->assign('files',$files);		
		
        // Assign all the module vars
        return $this->view->fetch('admin/sandh/sources.tpl');
    }

	    /**
     */
	public function sandh_modify_source($args)
    {		
        // Create Form output object
        $render = FormUtil::newForm('Mediasharex', $this);

        // Return the output that has been generated by this function
        return $render->execute("admin/sandh/modify/source.tpl", new Mediasharex_Handler_ModifySource());
    
	}

    /**
     */
    public function sandh_reload_sources()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		
		$mediaSources = new Mediasharex_Manager_MediaSources();				
		$status = $mediaSources->reloadSources();
				
		if ($status) {			
        $this->registerStatus($this->__('Done database is actual now.'));				
		}else{			
        // the module configuration has been updated successfuly
        $this->registerError($this->__('Something went wrong check sources storage.'));			
		}				
				
						
        // Assign all the module vars
        return $this->managesources();
    }
	
	
    /**
     */
    public function media_types()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$sandhlinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSandHLinks');
		$this->view->assign('sandhlinks', $sandhlinks);		
		

        $page   = $this->request->query->get('page',  isset($args['page']) ? $args['page'] : 1);		
		
		$mediaHandlers = new Mediasharex_Manager_MediaHandlers();
		$mediaHandlers->setPage($page);
		$mediaHandlers->setOrderby('id','ASC');
		$mediaHandlers_array = $mediaHandlers->getAll();
		$pager = $mediaHandlers->getPager();		

        // Assign all the module vars
        $this->view->assign('mediaHandlers',$mediaHandlers_array)
						  ->assign('pager',$pager)
						  ->assign('files',$files);	
		
        // Assign all the module vars
        return $this->view->fetch('admin/media_types.tpl');
    }	
	
	
	
	

	
	    /**
     */
    public function import()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
		
		
		//Get users module settings
		$enableimporttables = ModUtil::getVar('Mediasharex','enableimporttables',false);			
		

		
		
		
		$oldversion = ModUtil::apiFunc('Mediasharex', 'import', 'findMediashareModule');
        if ($oldversion){
        $mediashare_tables = ModUtil::apiFunc('Mediasharex', 'import', 'tablesPerVersion',$oldversion['version']);
		}
		
		$tables = DBUtil::getTables();

		//$mxctables = ModUtil::apiFunc('Mediasharex', 'import', 'getMediasharexTablesNames');

				
        // Assign all the module vars
        return $this->view->assign($modulevars)
						  ->assign('foundmediashare',$oldversion)
						  ->assign('enableimporttables',$enableimporttables)						  
						  ->assign('compat_tables',ModUtil::apiFunc('Mediasharex', 'import', 'MatchCompatibititeTables'))						  
            			  ->fetch('admin/import.tpl');
    }


	    /**
    */
    public function import_enabletables()
    {
		$enabletablesmode = $this->request->getPost()->get('enableimporttables', false);
		$this->setVar('enableimporttables', $enabletablesmode);	
        return $this->import();	
		
	}
    /**
    */
    public function import_manage()
    {
        // Security check
        if (!SecurityUtil::checkPermission($this->name . '::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
			

        // Confirm the forms authorisation key
        //$this->checkCsrfToken();

		$mode = $this->request->getPost()->get('mode', false);
		$import = $this->request->getPost()->get('import', false);		
		if ($mode) {			
		$to_import[$mode] = $import[$mode];
		$imported = ModUtil::apiFunc('Mediasharex', 'import', 'import',$to_import);					
		}else{			
        // the module configuration has been updated successfuly
        $this->registerStatus($this->__('Nothing to import.'));			
		}		
				
        // Assign all the module vars
        return $this->view->assign('mode',$mode)
						  ->assign('imported',$imported)
        				  ->fetch('admin/import_status.tpl');
    }	
	


	

}