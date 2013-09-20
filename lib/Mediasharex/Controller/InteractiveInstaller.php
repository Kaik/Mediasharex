<?php
/**
 * Mediasharex
 */
class Mediasharex_Controller_InteractiveInstaller extends Zikula_Controller_AbstractInteractiveInstaller
{
    /**
      */
    protected function getDefaultModVars()
    {
        return array();
    }

    /**
     */
    public function install()
    {
  		
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }
		$this->view = Zikula_View::getInstance($this->name);
		$this->view->caching = false;
        // Get parameters from whatever input we need
 
    	// See if we are here from a call-back from a form submission.  This is
    	// for us, and has nothing to do with the Modules system module
    	// knowing that the interactive process is complete.
    	$step   = $this->request->getPost()->get('step', 1); 
		$this->view->assign('step', $step);
		
		
if ($step == 1) {
			
			
    	// turn off extra tables 	
		$this->setVar('import_enableImportTables', false);	
			
		// tables     
        $tables = array('albums',
                    'media',
                    'keywords',
                    'mediastore',
                    'mediadb',
                    'mediahandlers',
                    'sources',
                    'access',
                    'invitation'
                   );
		
    	// Create the mediasharex tables
    	foreach ($tables as $table) {
	        if (!DBUtil::createTable("mediasharex_$table")) {
	         $installed_tables[$table] =  false;
	        }else{
	         $installed_tables[$table] =  true;	
	        }
    	}


   		// insert default category
        try {
            $this->createCategoryTree();
        } catch (Exception $e) {
            LogUtil::registerError($this->__f('Did not create default categories (%s).', $e->getMessage()));
        }
			
        // get default module vars
        // upload limit			
		$max_post_upload = ini_get('post_max_size');		
		$max_post_upload = trim($max_post_upload);
    	$last = strtolower($max_post_upload[strlen($max_post_upload)-1]);
    	switch($last) {
        case 'g':
        $max_post_upload *= 1073741824;
       	case 'm':
        $max_post_upload *= 1048576;
       	case 'k':
        $max_post_upload *= 1024;
    	}
		
		// previews 
		$previews = array (
		  'full' => 
		  array (
		    'width' => '780',
		    'height' => '580',
		    'class' => 'mediasharex-icon-sign-blank',
		    'richmedia' => '1'
		  ),
		  'thumbnail-large' => 
		  array (
		    'width' => '380',
		    'height' => '380',
		    'class' => 'mediasharex-icon-th-large',
		    'richmedia' => '1'
		  ),
		  'thumbnail' => 
		  array (
		    'width' => '180',
		    'height' => '150',
		    'class' => 'mediasharex-icon-th',
		    'richmedia' => '1'
		  ),
		  'thumbnail-list' => 
		  array (
		    'width' => '280',
		    'height' => '250',
		    'class' => 'mediasharex-icon-th-list',
		    'richmedia' => '1'
		  ),
		  'icon' => 
		  array (
		    'width' => '50',
		    'height' => '50',
		    'class' => 'mediasharex-icon-list-alt',
		    'default' => '1'
		  )
		);
		$this->setVar('previews', $previews);
		
		
		// construct array
        $install_options = array(	        
        'albums_defaultTheme' 			=> 'standard',

    	'general_mediaDirName' 			=> str_replace('/modules/Mediasharex/lib/Mediasharex/Controller', '/mediasharex', dirname(__FILE__)),
    	'general_tmpDirName' 			=> '/tmp',    	
    	'general_mediaSizeLimitSingle' 	=> $max_post_upload,	// php limit
    	'general_mediaSizeLimitTotal' 	=> 5000000,

    	'general_startPage' 			=> 'home',		

        'rootname' 						=> 'Top Album',
		'activate' 						=> false			
		);
        

		// reset sesion 
		SessionUtil::delVar('interactive_init');
		
		
		// feed template
		
		$this->view->assign('installed_tables', $installed_tables);		
        $this->view->assign('install_options', $install_options);

		//themes
		$themes = Mediasharex_Util_AlbumThemes::getThemesSelect();
		$this->view->assign('themes_select',$themes);
		
		//sources
		$mediaSources = new Mediasharex_Manager_MediaSources();			
		$this->view->assign('found_sources',count($mediaSources->getSourcesDir()));		

		//handlers
		$mediaHandlers = new Mediasharex_Manager_MediaHandlers();			
		$this->view->assign('found_handlers',count($mediaHandlers->getHandlersDir()));		
		
		//info
		$this->view->assign('fileUploadsAllowed', ini_get('file_uploads'));		
		
		//other
		$this->view->assign('id', SessionUtil::getVar('modules_id'));
		$this->view->assign('startnum', SessionUtil::getVar('modules_startnum'));
		$this->view->assign('letter', SessionUtil::getVar('modules_letter'));
		$this->view->assign('state', SessionUtil::getVar('modules_letter'));
		$this->view->assign('activate', (bool) FormUtil::getPassedValue('activate'));

        return $this->view->fetch('admin/install/install_step_1.tpl');
    
		}
elseif ($step == 2)
		{
			
		// save settings	
        $install_options = $this->request->getPost()->get('install_options');
		
		if (is_array($install_options)){
		foreach ($install_options as $optionname => $value) {			
			 if ($optionname !== 'activate' || $optionname !== 'rootname'){	
			 $this->setVar($optionname, $value);	
			 }
		 }				
		}
        $this->view->assign('install_options', $install_options);  

		// add handlers from dir
		$mediaHandlers = new Mediasharex_Manager_MediaHandlers();
		$mediahandlers_checked = $mediaHandlers->reloadhandlers();
		$this->view->assign('mediahandlers_checked', $mediahandlers_checked);			
		// add sources from dir
		$mediaSources = new Mediasharex_Manager_MediaSources();
		$mediasources_checked = $mediaSources->reloadsources();
		$this->view->assign('mediasources_checked', $mediasources_checked);			
		
		//create albums tree
		$tree = new Mediasharex_Util_AlbumTree();
		$root = $tree->createRootNode($install_options['rootname']);
		$this->view->assign('root', $root);		
		$system_album = $tree->insertChildNode('System', $root['id']);
		$this->view->assign('system_album', $system_album);
		$user_album = $tree->insertChildNode('Users', $root['id']);
		$this->view->assign('user_album', $user_album);
		
		// dir checks
		$dir_check['general_mediaDirName']['writable'] = ModUtil::apiFunc('Mediasharex', 'admin', 'mediashareDirIsWritable',$install_options['general_mediaDirName']);
		$dir_check['general_tmpDirName']['writable']   = ModUtil::apiFunc('Mediasharex', 'admin', 'mediashareDirIsWritable',$install_options['general_tmpDirName']);						
        $this->view->assign('dir_check', $dir_check);
		
				
        return $this->view->fetch('admin/install/install_step_2.tpl');
} else {
//step 3	
	 return ModUtil::func(ModUtil::url('Modules', 'admin', 'initialise', array(
                'csrftoken' => SecurityUtil::generateCsrfToken(),
                'activate' => true
                )));	
		
     }       
	
    }

    /**
      */
    public function upgrade($oldversion)
    {
        // Security check
        if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }

        // Update successful
        return true;
    }

    /**
     */
    public function uninstall()
    {
       
        // Deletion successful
        return true;
    }


	    /**
     * create the category tree
     *
     * @throws Zikula_Exception_Forbidden If Root category not found.
     *
     * @return boolean
     */
    private function createCategoryTree()
    {
        // create root category
        CategoryUtil::createCategory(
            '/__SYSTEM__/Modules',
            'Mediasharex',
            null,
            $this->__('Mediasharex'),
            $this->__('Media Module')
        );
        // create albums subcategory
        CategoryUtil::createCategory(
            '/__SYSTEM__/Modules/Mediasharex',
            'Albums',
            null,
            $this->__('Albums'),
            $this->__('Initial Albums category created on install')
        );
	        // create subcategory
	        CategoryUtil::createCategory(
	            '/__SYSTEM__/Modules/Mediasharex/Albums',
	            'Nature',
	            null,
	            $this->__('Nature'),
	            $this->__('Nature')
	        );
	        // create subcategory
	        CategoryUtil::createCategory(
	            '/__SYSTEM__/Modules/Mediasharex/Albums',
	            'People',
	            null,
	            $this->__('People'),
	            $this->__('People')
	        );	
		
		// create media subcategory				
        CategoryUtil::createCategory(
            '/__SYSTEM__/Modules/Mediasharex',
            'Media',
            null,
            $this->__('Media'),
            $this->__('Initial media category created on install')
        );
	        // create subcategory
	        CategoryUtil::createCategory(
	            '/__SYSTEM__/Modules/Mediasharex/Media',
	            'Funny',
	            null,
	            $this->__('Funny'),
	            $this->__('Funny')
	        );
	        // create subcategory
	        CategoryUtil::createCategory(
	            '/__SYSTEM__/Modules/Mediasharex/Media',
	            'Cars',
	            null,
	            $this->__('Cars'),
	            $this->__('Cars')
	        );
		
        // get the category path to insert Mediasharex categories
        $albumrootcat = CategoryUtil::getCategoryByPath('/__SYSTEM__/Modules/Mediasharex/Albums');        
        if ($albumrootcat) {
            // create an entry in the categories registry to the Main property
            if (!CategoryRegistryUtil::insertEntry('Mediasharex', 'mediasharex_albums', 'Albums', $albumrootcat['id'])) {
                throw new Zikula_Exception("Cannot insert Category Registry entry.");
            }
        } else {
            $this->throwNotFound("Root category not found.");
        }
		
		// get the category path to insert Mediasharex categories
        $mediarootcat = CategoryUtil::getCategoryByPath('/__SYSTEM__/Modules/Mediasharex/Media');		
        if ($mediarootcat) {
            // create an entry in the categories registry to the Main property
            if (!CategoryRegistryUtil::insertEntry('Mediasharex', 'mediasharex_media', 'Media', $mediarootcat['id'])) {
                throw new Zikula_Exception("Cannot insert Category Registry entry.");
            }
        } else {
            $this->throwNotFound("Root category not found.");
        }				

        return true;
    }
	

        
}