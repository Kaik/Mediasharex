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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$infolinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getInfoLinks');
		$this->view->assign('infolinks', $infolinks);		
		
		
		//Enviroment
		$php_vars = array();
		$php_vars['file_uploads']  = ini_get('file_uploads');
		$php_vars['upload_tmp_dir']	= ini_get('upload_tmp_dir'); 
		$php_vars['max_input_nesting_level'] =	ini_get('max_input_nesting_level');
		$php_vars['max_input_vars'] =	ini_get('max_input_vars');
		$php_vars['upload_max_filesize'] =	ini_get('upload_max_filesize');
		$php_vars['max_file_uploads'] =	ini_get('max_file_uploads');
				
		$php_vars['post_max_size'] = ini_get('post_max_size');		
		$max_post_upload = trim($php_vars['post_max_size']);
    	$last = strtolower($max_post_upload[strlen($max_post_upload)-1]);
    	switch($last) {
        case 'g':
        $max_post_upload *= 1073741824;
       	case 'm':
        $max_post_upload *= 1048576;
       	case 'k':
        $max_post_upload *= 1024;
    	}		
		$php_vars['post_max_size'] = $max_post_upload;
		$this->view->assign('php_vars', $php_vars);		
		
		
		// dir check
		$dir_check['general_mediaDirName']['writable'] = ModUtil::apiFunc('Mediasharex', 'admin', 'mediashareDirIsWritable',$modulevars['general_mediaDirName']);
		$dir_check['general_tmpDirName']['writable']   = ModUtil::apiFunc('Mediasharex', 'admin', 'mediashareDirIsWritable',$modulevars['general_tmpDirName']);		
        $this->view->assign('dir_check', $dir_check);


		// Docs
        $lang   = $this->request->query->get('lang',  isset($args['lang']) ? $args['lang'] : 'en');	
		$file_path = 'modules/Mediasharex/docs/'.$lang.'/admin/1_3 Status.rst';
		$file_content = Mediasharex_Util_RstFile::readFile($file_path);
		$this->view->assign('file_content',$file_content);	


		//Get albums		
		$albumsManager = new Mediasharex_Manager_Albums();
		$albums = $albumsManager->getCount();
		$this->view->assign('albums',$albums);
		//Get media		
		$mediaManager = new Mediasharex_Manager_MediaItems();
		$media = $mediaManager->getCount();
		$this->view->assign('media',$media);

		//Get media types
		
		//Get handlers media types		
		$handlersManager = new Mediasharex_Manager_MediaHandlers();
		
		$mediatypes = $handlersManager->getAll();
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));

       $langtype   = $this->request->query->get('langtype',  isset($args['langtype']) ? $args['langtype'] : 'en');
		$this->view->assign('langtype',$langtype);
       $dirtype   = $this->request->query->get('dirtype',  isset($args['dirtype']) ? $args['dirtype'] : 'admin');
		$this->view->assign('dirtype',$dirtype);
       $file_name   = $this->request->query->get('file_name',  isset($args['file_name']) ? $args['file_name'] : '1_0 Introduction.rst');
		$this->view->assign('file_name',$file_name);		
		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
        // Confirm the forms authorisation key
        $this->checkCsrfToken();

        $redirect = $this->request->getPost()->get('redirect');
		$this->view->assign('redirect',$redirect);
		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
        // Confirm the forms authorisation key
        $this->checkCsrfToken();

        $redirect = $this->request->getPost()->get('redirect');
		$file_path = $this->request->getPost()->get('file_path');		
		$file_content = $this->request->getPost()->get('file_content');		

		$ok = Mediasharex_Util_RstFile::saveFile($file_path,$file_content);		
		if(!$ok){
        $this->registerError($this->__('File not saved!'));						
		}		
        $this->registerStatus($this->__('File saved successfully!'));		
        return $this->redirect($redirect);		
    }

    /**
     */
    public function settings_general()
    {
        // Security check
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		
		// Docs
        $lang   = $this->request->query->get('lang',  isset($args['lang']) ? $args['lang'] : 'en');	
		$file_path = 'modules/Mediasharex/docs/'.$lang.'/admin/1_2 General settings.rst';
		$file_content = Mediasharex_Util_RstFile::readFile($file_path);
		$this->view->assign('file_content',$file_content);	


		// dir check
		$dir_check['general_mediaDirName']['writable'] = ModUtil::apiFunc('Mediasharex', 'admin', 'mediashareDirIsWritable',$modulevars['general_mediaDirName']);
		$dir_check['general_tmpDirName']['writable']   = ModUtil::apiFunc('Mediasharex', 'admin', 'mediashareDirIsWritable',$modulevars['general_tmpDirName']);		
        $this->view->assign('dir_check', $dir_check);

		
		//system tmp dir
		$sys_temp_dir = sys_get_temp_dir();
		$this->view->assign('sys_temp_dir', $sys_temp_dir);
		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));

        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$modulevars = $this->request->getPost()->get('modulevars');

		if (is_array($modulevars)){
		foreach ($modulevars as $optionname => $value) {	
		$this->setVar($optionname, $value);	
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);

		$previewsManager = new Mediasharex_Manager_Previews();
		$this->view->assign('previews', $previewsManager->getPreviews());

		// Docs
        $lang   = $this->request->query->get('lang',  isset($args['lang']) ? $args['lang'] : 'en');	
		$file_path = 'modules/Mediasharex/docs/'.$lang.'/admin/5_0 Previews.rst';
		$file_content = Mediasharex_Util_RstFile::readFile($file_path);
		$this->view->assign('file_content',$file_content);

		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));

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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		$themes = Mediasharex_Util_AlbumThemes::getThemesSelect();
		$this->view->assign('themes_select',$themes);

		// Docs
        $lang   = $this->request->query->get('lang',  isset($args['lang']) ? $args['lang'] : 'en');	
		$file_path = 'modules/Mediasharex/docs/'.$lang.'/admin/3_0 Albums.rst';
		$file_content = Mediasharex_Util_RstFile::readFile($file_path);
		$this->view->assign('file_content',$file_content);		
		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));

        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$modulevars = $this->request->getPost()->get('modulevars');

		if (is_array($modulevars)){
		foreach ($modulevars as $optionname => $value) {	
		$this->setVar($optionname, $value);	
		}				
		}				
		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);


		// Docs
        $lang   = $this->request->query->get('lang',  isset($args['lang']) ? $args['lang'] : 'en');	
		$file_path = 'modules/Mediasharex/docs/'.$lang.'/admin/4_0 Media.rst';
		$file_content = Mediasharex_Util_RstFile::readFile($file_path);
		$this->view->assign('file_content',$file_content);

		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));

        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$modulevars = $this->request->getPost()->get('modulevars');


		if (is_array($modulevars)){
		foreach ($modulevars as $optionname => $value) {	
		$this->setVar($optionname, $value);	
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
    public function settings_access()
    {
        // Security check
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);

		// Docs
        $lang   = $this->request->query->get('lang',  isset($args['lang']) ? $args['lang'] : 'en');	
		$file_path = 'modules/Mediasharex/docs/'.$lang.'/admin/3_2 Albums Access.rst';
		$file_content = Mediasharex_Util_RstFile::readFile($file_path);
		$this->view->assign('file_content',$file_content);

		
		//Get users module settings
		$settingslinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSettingsLinks');
		$this->view->assign('settingslinks', $settingslinks);		


		$access_s = Mediasharex_Util_Access::getAccessesSelect();
		$this->view->assign('access_select',$access_s);


		
        // Assign all the module vars
        return $this->view->fetch('admin/settings/access.tpl');
    }
    /**
   */
    public function settings_access_update()
    {
        // Security check
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));

        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$modulevars = $this->request->getPost()->get('modulevars');

		if (is_array($modulevars)){
		foreach ($modulevars as $optionname => $value) {
		$this->setVar($optionname, $value);	
		}				
		}				
		
        // the module configuration has been updated successfuly
        $this->registerStatus($this->__('Done! Saved module configuration.'));

        // This function generated no output, and so now it is complete we redirect
        // the user to an appropriate page for them to carry on their work
        $this->redirect(ModUtil::url($this->name, 'admin', 'settings_access'));
    }
    /**
     */
    public function settings_storage()
    {
        // Security check
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);

		// Docs
        $lang   = $this->request->query->get('lang',  isset($args['lang']) ? $args['lang'] : 'en');	
		$file_path = 'modules/Mediasharex/docs/'.$lang.'/admin/7_0 Storage.rst';
		$file_content = Mediasharex_Util_RstFile::readFile($file_path);
		$this->view->assign('file_content',$file_content);

		
		//Get users module settings
		$settingslinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSettingsLinks');
		$this->view->assign('settingslinks', $settingslinks);		


		$storage_s = Mediasharex_Util_Storage::getStoragesSelect();
		$this->view->assign('storages_select',$storage_s);


		
        // Assign all the module vars
        return $this->view->fetch('admin/settings/storage.tpl');
    }
    /**
   */
    public function settings_storage_update()
    {
        // Security check
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));

        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$modulevars = $this->request->getPost()->get('modulevars');

		if (is_array($modulevars)){
		foreach ($modulevars as $optionname => $value) {
		$this->setVar($optionname, $value);	
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);

		// Docs
        $lang   = $this->request->query->get('lang',  isset($args['lang']) ? $args['lang'] : 'en');	
		$file_path = 'modules/Mediasharex/docs/'.$lang.'/admin/4_2 Media sources.rst';
		$file_content = Mediasharex_Util_RstFile::readFile($file_path);
		$this->view->assign('file_content',$file_content);

		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));

        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$modulevars = $this->request->getPost()->get('modulevars');

		if (is_array($modulevars)){
		foreach ($modulevars as $optionname => $value) {
		$this->setVar($optionname, $value);	
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);

		// Docs
        $lang   = $this->request->query->get('lang',  isset($args['lang']) ? $args['lang'] : 'en');	
		$file_path = 'modules/Mediasharex/docs/'.$lang.'/admin/4_3 Media handlers.rst';
		$file_content = Mediasharex_Util_RstFile::readFile($file_path);
		$this->view->assign('file_content',$file_content);

		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$modulevars = $this->request->getPost()->get('modulevars');

		if (is_array($modulevars)){
		foreach ($modulevars as $optionname => $value) {
		$this->setVar($optionname, $value);	
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);

		// Docs
        $lang   = $this->request->query->get('lang',  isset($args['lang']) ? $args['lang'] : 'en');	
		$file_path = 'modules/Mediasharex/docs/'.$lang.'/admin/6_0 Import.rst';
		$file_content = Mediasharex_Util_RstFile::readFile($file_path);
		$this->view->assign('file_content',$file_content);

		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));

        // Confirm the forms authorisation key
        $this->checkCsrfToken();

		$modulevars = $this->request->getPost()->get('modulevars');

		if (is_array($modulevars)){
		foreach ($modulevars as $optionname => $value) {
		$this->setVar($optionname, $value);	
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
				//Get albums		
		$albumsManager = new Mediasharex_Manager_Albums();
		$albums = $albumsManager->getCount();
		$this->view->assign('albums',$albums);
		//Get media		
		$mediaManager = new Mediasharex_Manager_MediaItems();
		$media = $mediaManager->getCount();
		$this->view->assign('media',$media);

		//Get media types
		
		//Get handlers media types		
		$handlersManager = new Mediasharex_Manager_MediaHandlers();
		
		$mediatypes = $handlersManager->getAll();
		$this->view->assign('mediahandlers',$mediahandlers);
		//Get sources		
		$sourcesManager = new Mediasharex_Manager_MediaSources();
		$sources = $sourcesManager->getCount();		
		$this->view->assign('sources',$sources);
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$managerlinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getManagerLinks');
		$this->view->assign('managerlinks', $managerlinks);		

        $album  = $this->request->query->get('album',  isset($args['album']) ? $args['album'] : 1);       
        $tree = new Mediasharex_Util_AlbumTree();									
		$this->view->assign('tree', $tree->getBrowser($album));

		$albumManager = new Mediasharex_Manager_Album($album);			
		$album_arr = $albumManager->getItemArray();
		$access = new Mediasharex_Util_Access();
		$album_arr['access'] = $access->getAlbumAccess($album_arr);			
	    $this->view->assign('album',     $album_arr);
		$this->view->assign('subalbums',$albumManager->getSubAlbums());
		$this->view->assign('mediaitems',$albumManager->getMediaItems());

	
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
 
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		//Get users module settings
		$modulevars = ModUtil::getVar('Mediasharex');
		$this->view->assign('modulevars', $modulevars);
		
		//Get users module settings
		$sandhlinks = ModUtil::apiFunc('Mediasharex', 'admin', 'getSandHLinks');
		$this->view->assign('sandhlinks', $sandhlinks);

		//load sources
		$mediaSources = new Mediasharex_Manager_MediaSources();
		//get sources files	
		$sourcesFiles = $mediaSources->getSourcesDir();
		$this->view->assign('sourcesFiles', $sourcesFiles);
		//get active sources
		$mediaSources->setActive(1); 		
		$activeSources = $mediaSources->getAll();
		$this->view->assign('activeSources', $activeSources);
						
		//load handlers
		$mediaHandlers = new Mediasharex_Manager_MediaHandlers();	
		//get handlers files
		$handlersFiles = $mediaHandlers->getHandlersDir();
		$this->view->assign('handlersFiles', $handlersFiles);
		//get active handlers 
		$mediaHandlers->setActive(1); 		
		$activeHandlers = $mediaHandlers->getAll();
		$this->view->assign('activeHandlers', $activeHandlers);		
		
				
        // Assign all the module vars
        return $this->view->fetch('admin/sandh/sandh.tpl');
    }

    /**
     */
    public function sandh_handlers()
    {
        // Security check
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		
		$mediaHandlers = new Mediasharex_Manager_MediaHandlers();				
		$status = $mediaHandlers->reloadHandlers();
				
		if ($status) {			
        $this->registerStatus($this->__('Done database is actual now.'));				
		}else{			
        // the module configuration has been updated successfuly
        $this->registerError($this->__('Something went wrong check handlers storage.'));			
		}				
				
						
        // Assign all the module vars
        return $this->sandh_handlers();
    }
	
	
	    /**
     */
    public function sandh_sources()
    {
        // Security check
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		
		$mediaSources = new Mediasharex_Manager_MediaSources();				
		$status = $mediaSources->reloadSources();
				
		if ($status) {			
        $this->registerStatus($this->__('Done database is actual now.'));				
		}else{			
        // the module configuration has been updated successfuly
        $this->registerError($this->__('Something went wrong check sources storage.'));			
		}				
				
						
        // Assign all the module vars
        return $this->sandh_sources();
    }
	
	
    /**
     */
    public function media_types()
    {
        // Security check
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
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
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		
		//Get users module settings
		//$enableimporttables = ModUtil::getVar('Mediasharex','enableimporttables',false);			
		

		
		
		/*
		$oldversion = ModUtil::apiFunc('Mediasharex', 'import', 'findMediashareModule');
        if ($oldversion){
        $mediashare_tables = ModUtil::apiFunc('Mediasharex', 'import', 'tablesPerVersion',$oldversion['version']);
		}
		
		$tables = DBUtil::getTables();

		//$mxctables = ModUtil::apiFunc('Mediasharex', 'import', 'getMediasharexTablesNames');
		*/
				
        // Assign all the module vars
        return $this->view->assign($modulevars)
						  ->assign('foundmediashare',$oldversion)
						  ->assign('enableimporttables',$enableimporttables)						  
						  ->assign('compat_tables',ModUtil::apiFunc('Mediasharex', 'import', 'MatchCompatibititeTables'))						  
            			  ->fetch('admin/import/import.tpl');
    }


	/**
    */
    public function import_enabletables()
    {
    	
		// Security check
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
		
		$enabletablesmode = $this->request->getPost()->get('enableimporttables', false);
		$this->setVar('enableimporttables', $enabletablesmode);	
        return $this->import();	
		
	}
    /**
    */
    public function import_manage()
    {
        // Security check
		$this->throwForbiddenUnless(Mediasharex_Util_Access::checkPerms(ACCESS_ADMIN, '::'));
			

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