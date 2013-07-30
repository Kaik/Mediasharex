<?php
/**
 * Mediasharex
 */

/**
 * Administrative API functions.
 */
class Mediasharex_Api_Admin extends Zikula_AbstractApi
{
	
	
	
    public function mediashareDirIsWritable($dir)
	{
    return is_dir($dir) && is_writable($dir);
	}	

    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getLinks()
    {
        $links = array();
		
		$modulevars = ModUtil::getVar('Mediasharex');

		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'info'),
            				 'text' => $this->__(' Info'),
            				 'class' => 'mediasharex-icon-laptop',
							 'links' => $this->getInfoLinks());
        }

		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'info_docs'),
            				 'text' => $this->__(' Documentation'),
            				 'class' => 'mediasharex-icon-cabinet');
        }
		
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'settings_general'),
            				 'text' => $this->__(' Settings'),
            				 'class' => 'mediasharex-icon-cogs',
							 'links' => $this->getSettingsLinks());
        }		
		
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'manager'),
            				 'text' => $this->__(' Content manager'),
            				 'class' => 'mediasharex-icon-folder',
							 'links' => $this->getManagerLinks());
        }		
		
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'sandh'),
            				 'text' => $this->__(' Sources & Handlers'),
            				 'class' => 'mediasharex-icon-equalizer',
							 'links' => $this->getSandHLinks());
        }
		
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'media_types'),
            				 'text' => $this->__(' Media types'),
            				 'class' => 'mediasharex-icon-star',
							 'links' => $this->getMediaTypesLinks());
        }		
		
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'import'),
            				 'text' => $this->__(' Import'),
            				 'class' => 'mediasharex-icon-loop',
							 'links' => $this->getImportLinks());
        }			
		
		
		
		
	/*	
		
		
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'mainsettings'), 'text' => $this->__('Main settings'), 'class' => 'z-icon-es-config');
        }






        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'managealbums'), 'text' => $this->__('Albums'), 'class' => 'z-icon-es-display');
        }
		
        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'manageitems'), 'text' => $this->__('Media'), 'class' => 'z-icon-es-display');
        }
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'managemediastore'), 'text' => $this->__('Media store'), 'class' => 'z-icon-es-display');
        }
		
        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'managehandlers'), 'text' => $this->__('Handlers'), 'class' => 'z-icon-es-display');
        }
				
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'managesources'), 'text' => $this->__('Sources'), 'class' => 'z-icon-es-display');
        }
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'manageinvitations'), 'text' => $this->__('Invitations'), 'class' => 'z-icon-es-display');
        }
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'import'), 'text' => $this->__('Import'), 'class' => 'z-icon-es-filter');
        }	
	 * 
	 * 
	 * 
	 * 
	 * 
	 * 
	 */	
 
        return $links;
    }

    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getInfoLinks()
    {
        $links = array();
		
		$modulevars = ModUtil::getVar('Mediasharex');

		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'info'),
             'text' => $this->__('Status'),
              'class' => 'z-icon-es-confi');
        }
		
        return $links;
    }
    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getDocsTree()
    {
    	
        $links = array();

	
		$docs = $this->getDocs();
		
		foreach($docs as $key => $path){
		
		$exploded = explode('/',$path);	
		
		$lang = (string)$exploded[0];
		$type_dir = (string)$exploded[1];
		$file_name = (string)$exploded[2];	

		//$links[] = $this->getDocLink($url,$file_name,$class,$links); 			
		$links[$lang][$type_dir][$file_name]['langtype'] = $lang; 	
		$links[$lang][$type_dir][$file_name]['dirtype'] = $type_dir;	
		}

		//foreach($links as $lang => $type_dir){
		//$links_out[$lang] = getDocLink($url,$text,$class,$links); 			
		//}
		
	
		return $links;	
	}	
    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getDocsLinks()
    {
        $links = array();
		$docs_tree = $this->getDocsTree();	
		$links = $this->getDocsLangLinks($docs_tree);
        return $links;
    }
		
    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getDocsLangLinks($tree)
    {
		$links_arr = array();
		foreach($tree as $lang => $type_folders){
		$url = ModUtil::url($this->name, 'admin', 'info_docs');
		$class = 'mediasharex-icon-folder-open';				
		$file = $lang;
		$links = $this->getDocsTypeLinks($tree[$lang]);	
		$links_arr[] = $this->getDocLink($url, $file, $class, $links);
		}
		return $links_arr;
    }
		
    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getDocsTypeLinks($folders)
    {
        $links_arr = array();
		foreach($folders as $folder_name => $files){
		$url = ModUtil::url($this->name, 'admin', 'info_docs');
		$class = 'mediasharex-icon-folder-open';							
		$file = $folder_name;
		$links = $this->getDocsFileLinks($files);	
		$links_arr[] = $this->getDocLink($url, $file, $class, $links);
		}
		return $links_arr;
    }
		
    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getDocsFileLinks($files)
    {
        $links_arr = array();					
		foreach($files as $file_name => $file_check){
		$url = ModUtil::url($this->name, 'admin', 'info_docs',array('langtype'=>$file_check['langtype'],'dirtype'=>$file_check['dirtype'],'file_name'=>$file_name));			
		$class = 'mediasharex-icon-file';	
		$file = $file_name;
		$links = false;	
		$links_arr[] = $this->getDocLink($url, $file, $class, $links);	
		}		
        return $links_arr;
    }				

    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getDocLink($url,$text,$class,$links)
    {
    	
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $link = array('url' => $url,
            				 'text' => $text,
            				 'class' => $class,
							 'links' => $links);
        }		
	
		return $link;	
	}
    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getDocs()
    {

		$rootPath = 'modules/Mediasharex/docs';
        $docs = FileUtil::getFiles($rootPath,  true, true, false, false);
		return $docs;
	}
    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getSettingsLinks()
    {
        $links = array();
		
		$modulevars = ModUtil::getVar('Mediasharex');

		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'settings_general'), 'text' => $this->__('General settings'), 'class' => 'z-icon-es-confi');
        }

        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'settings_display'), 'text' => $this->__('Display'), 'class' => 'z-icon-es-displa');
        }
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'settings_albums'), 'text' => $this->__('Albums'), 'class' => 'z-icon-es-displa');
        }
        		
        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'settings_media'), 'text' => $this->__('Media'), 'class' => 'z-icon-es-displa');
        }
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'settings_storage'), 'text' => $this->__('Storage'), 'class' => 'z-icon-es-displa');
        }
        
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'settings_handlers'), 'text' => $this->__('Handlers'), 'class' => 'z-icon-es-displa');
        }
    	if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'settings_sources'), 'text' => $this->__('Sources'), 'class' => 'z-icon-es-displa');
        }
    	if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'settings_import'), 'text' => $this->__('Import'), 'class' => 'z-icon-es-displa');
        }            
				
        return $links;
    }

    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getManagerLinks()
    {
        $links = array();
		
		$modulevars = ModUtil::getVar('Mediasharex');

		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'manager'), 'text' => $this->__('Manager'), 'class' => 'z-icon-es-confi');
        }

        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'manager_albums'), 'text' => $this->__('Albums'), 'class' => 'z-icon-es-displa');
        }
		
        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'manager_media'), 'text' => $this->__('Media'), 'class' => 'z-icon-es-displa');
        }
		
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'manager_previews'), 'text' => $this->__('Previews'), 'class' => 'z-icon-es-displa');
        }
		
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'manager_invitations'), 'text' => $this->__('Invitations'), 'class' => 'z-icon-es-displa');
        }
                
			
        return $links;
    }

    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getSandHLinks()
    {
        $links = array();
		
		$modulevars = ModUtil::getVar('Mediasharex');

		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'sandh'), 'text' => $this->__('Media handling'), 'class' => 'z-icon-es-confi');
        }

        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'sandh_sources'), 'text' => $this->__('Media sources'), 'class' => 'z-icon-es-displa');
        }
		
        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'sandh_handlers'), 'text' => $this->__('Media handlers'), 'class' => 'z-icon-es-displa');
        }
     
			
        return $links;
    }

    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getMediaTypesLinks()
    {
        $links = array();
		
		$modulevars = ModUtil::getVar('Mediasharex');

		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'mainsettings'), 'text' => $this->__('Main settings'), 'class' => 'z-icon-es-confi');
        }

        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'managealbums'), 'text' => $this->__('Albums'), 'class' => 'z-icon-es-displa');
        }
		
        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'manageitems'), 'text' => $this->__('Media'), 'class' => 'z-icon-es-displa');
        }
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'managemediastore'), 'text' => $this->__('Media store'), 'class' => 'z-icon-es-displa');
        }
        
			
        return $links;
    }

    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getImportLinks()
    {
        $links = array();
		
		$modulevars = ModUtil::getVar('Mediasharex');

		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'import'), 'text' => $this->__('Main settings'), 'class' => 'z-icon-es-confi');
        }

        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'managealbums'), 'text' => $this->__('Albums'), 'class' => 'z-icon-es-displa');
        }

			
        return $links;
    }



}