<?php

class Mediasharex_Util_Storage {
        
	private $storageName;
	private $_storage;

	/**
    * construct
	 * mode tmp 
    */
    public function __construct($storageName = null, $mode)
    {
    	if($storageName){
		$this->storageName = $storageName;	
		}else{
		$this->storageName = ModUtil::getVar('Mediasharex','storage_type','Dir');				
    	}       		
		
		$storageClass = 'Mediasharex_MediaStorage_'.$this->storageName;
		
		$this->_storage = new $storageClass($mode);	

    }

  /**
   * get
   */
    public static function getStorage()
    {
	return $this->storage;

	}

  /**
   * Utils
   * 
   */
   public function getStorages() 
	{								
		$storagesPath = 'modules/Mediasharex/lib/Mediasharex/MediaStorage';
        $storages = FileUtil::getFiles($storagesPath,  false, true, 'php', false);	

		return $storages;	
	}
	
   public function getStoragesSelect() 
	{								
        $storages = Mediasharex_Util_Storage::getStorages();
		$storages_select = array();
		foreach ($storages as $key => $storage) {
		$storages_select[$key] = array('text' => FileUtil::stripExtension($storage),'value'=> FileUtil::stripExtension($storage));				
		}
		return $storages_select;	
	}		
			     
}