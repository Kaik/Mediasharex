<?php

class Mediasharex_Util_Access {
        
	private $accessName;
	private $accessClass;
	private $_access;

	/**
    * construct
    */
    public function __construct($accessName = null)
    {       	
		$this->accessName = ModUtil::getVar('Mediasharex','access_type','Simple');	
		$this->accessClass = 'Mediasharex_Access_'.$this->accessName;	
        $this->_access = new $this->accessClass;
    }
	
	
	/**
    * Access mode methods
    */	
	
	
	public function getAccess() 
	{								
	return $this->_access->getAccess();
	}
	public function getAccessSelect() 
	{
	return $this->_access->getAccessSelect();	
   	}
   	public function getAlbumAccess($album) 
   	{							
	return $this->_access->getAlbumAccess($album);	
   	}
	

	/**
    * Util funcs
    */

  /**
     */
    public static function checkPerms($permlvl = null, $instance = null)
    {
        // fill default values if needed
        $permlvl = $permlvl ? $permlvl : ACCESS_OVERVIEW;
        $instance = $instance ? $instance : '::';

        // evaluate the access
        return SecurityUtil::checkPermission('Mediasharex::', $instance, $permlvl);

	}
  /**
     */
    public static function accessFileSelect()
    {


	}	

   public function getAccessFiles() 
	{								
		$accessPath = 'modules/Mediasharex/lib/Mediasharex/Access';
        $access = FileUtil::getFiles($accessPath,  false, true, 'php', false);	

		return $access;	
	}
	
   public function getAccessesSelect() 
	{								
        $accesses = Mediasharex_Util_Access::getAccessFiles();
		$accesses_select = array();
		foreach ($accesses as $key => $access) {
		$accesses_select[$key] = array('text' => FileUtil::stripExtension($access),'value'=> FileUtil::stripExtension($access));				
		}
		return $accesses_select;	
	}
	
	
	
		
			     
}