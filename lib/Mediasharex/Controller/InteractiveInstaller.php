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
        // Get parameters from whatever input we need
 
    	// See if we are here from a call-back from a form submission.  This is
    	// for us, and has nothing to do with the Modules system module
    	// knowing that the interactive process is complete.
    	$step   = $this->request->getPost()->get('step', 1);
 
    	if ($step == 1) {
    		
		$this->setVar('enableimporttables', false);	
			
        // Initialize the $upgradeOpts variable with defaults, which will keep
        // track of the selected options for us.
        $previous_mediashare = ModUtil::getInfoFromName('Mediashare');
        
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
		
    	// Create the mediashare tables
    	foreach ($tables as $table) {
	        if (!DBUtil::createTable("mediasharex_$table")) {
	         $installed_tables[$table] =  false;
	        }else{
	         $installed_tables[$table] =  true;	
	        }
    	}


        $install_options['mediaDirName'] = str_replace('/modules/Mediasharex/lib/Mediasharex/Controller', '/mediasharex', dirname(__FILE__));
        $install_options['tmpDirName'] = '/tmp';
   		$install_options['thumbnailSize'] = '100';
    	$install_options['previewSize'] = '400';
    	$install_options['mediaSizeLimitSingle'] = 250000;
    	$install_options['mediaSizeLimitTotal'] = 5000000;
    	$install_options['defaultAlbumTemplate'] = 'standard';
    	$install_options['allowTemplateOverride'] = 0;
    	$install_options['enableSharpen'] = 0;
    	$install_options['enableThumbnailStart'] = 1;
    	$install_options['vfs'] = 'fsdirect';		
		
        $install_options['activate'] = false; 
				
		SessionUtil::delVar('interactive_init');
		
        $this->view->caching = false;
        $this->view->assign('install_options', $install_options);
		$this->view->assign('step', $step);
		
		$this->view->assign('id', SessionUtil::getVar('modules_id'));
		$this->view->assign('startnum', SessionUtil::getVar('modules_startnum'));
		$this->view->assign('letter', SessionUtil::getVar('modules_letter'));
		$this->view->assign('state', SessionUtil::getVar('modules_letter'));
		$this->view->assign('activate', (bool) FormUtil::getPassedValue('activate'));
		
		$this->view->assign('fileUploadsAllowed', ini_get('file_uploads'));
		
		$this->view->assign('installed_tables', $installed_tables);
		$this->view->assign('previous_mediashare',$previous_mediashare);
        return $this->view->fetch('admin/install_step_1.tpl');
    	

		}
		elseif ($step == 2)
		{
			
			
        $install_options = $this->request->getPost()->get('install_options');
		
		if (is_array($install_options)){
		foreach ($install_options as $optionname => $value) {
			 if ($optionname !== 'activate'){	
			 $this->setVar($optionname, $value);	
			 }
		 }				
		}
  
		$dir_check['mediaDirName']['writable'] = ModUtil::apiFunc('Mediasharex', 'admin', 'mediashareDirIsWritable',$install_options['mediaDirName']);
		$dir_check['tmpDirName']['writable']   = ModUtil::apiFunc('Mediasharex', 'admin', 'mediashareDirIsWritable',$install_options['tmpDirName']);
		
        $this->view->caching = false;
        $this->view->assign('install_options', $install_options);
        $this->view->assign('dir_check', $dir_check);		
        return $this->view->fetch('admin/install_step_2.tpl');
		/*

		*/
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
     * create the default category tree
     */
    private function _createdefaultcategory($regpath = '/__SYSTEM__/Modules/Global')
    {
        // get the language file
        $lang = ZLanguage::getLanguageCode();

        // get the category path for which we're going to insert our place holder category
    
        $c = CategoryUtil::getCategoryByPath($regpath.'/MContent');
        if (!$c) {
            $c = CategoryUtil::getCategoryByPath($regpath);

            $args = array(
                'cid'   => $c['id'],
                'name'  => 'MCo',
                'dname' => array($lang => $this->__('Clip')),
                'ddesc' => array($lang => $this->__('Clip root category'))
            );
            if (!$this->createCategory($args)) {
                return false;
            }
        }
        return true;
    }
	
	    /**
     * create the default category tree
     */
    private function _tablesPerVersion($oldversion)
    {
	
    }
        
}