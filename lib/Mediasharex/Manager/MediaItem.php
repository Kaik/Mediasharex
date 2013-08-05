<?php
/**
 * Mediasharex
 */
class Mediasharex_Manager_MediaItem
{

    private $_item;

    private $tables;
    private $table;
    private $columns;
	
	private $original;


    /**
     * construct
     */
    public function __construct($id = null, $item = null)
    {
	  // Get database setup
        $this->tables = DBUtil::getTables();
		$this->table = 'mediasharex_media';
        $this->columns = $this->tables['mediasharex_media_column'];	

        $this->_item = new Mediasharex_Base_MediaItem();
        $this->original = new Mediasharex_Base_MediaStoreItem();
        if (isset($item)) {
            $this->_item->set($item);
        } elseif ($id > 0) {
            $this->_item->set($this->_getFromDB($id));
        } 

    }

    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function getItemArray()
    {
        if (!$this->_item) {
            return false;
        }

		$out = array_merge($this->original->toArray(),$this->_item->toArray());

        return $out;
    }
	
	
	    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function includeOriginal()
    {
        if (!$this->_item->getOriginal()) {
            return false;
        }
		
		//$this->original = 
		
		$store = new Mediasharex_Manager_MediaStoreItem($this->_item->getOriginal());
        
        $this->_item->setOriginal($store->getItemArray());
    }
	

    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function getItem()
    {
        if (!$this->_item) {
            return false;
        }

        return $this->_item;
    }
	
	private function _getFromDB($id)
	{
        if (!isset($id) || empty($id)) {
            return LogUtil::registerArgsError();
        }

        // init empty comment
        $item = array();

        $permFilter   = array();
        $permFilter[] = array('component_left'   => 'Mediasharex',
                              'component_middle' => '',
                              'component_right'  => '',
                              'instance_left'    => 'modname',
                              'instance_middle'  => 'objectid',
                              'instance_right'   => 'id',
                              'level'            => ACCESS_READ);
		$join[] = array(
	   'join_table' => 'mediasharex_mediastore',
       'join_field' => array('fileref','mimetype','width','height','bytes'),
       'object_field_name' => array('fileref','mimetype','width','height','bytes'),
       'compare_field_table' => 'original',
       'compare_field_join' => 'id',
       );					  
							  

        $item = DBUtil::selectExpandedObjectByID($this->table, $join, $id, 'id', null, $permFilter);		

	    $this->original->set($item);

		return $item;
		
	}


	    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function getPreviews()
    {
        if (!$this->_item->getId()) {
            return false;
        }
		
		//$this->original = 
		
		$store = new Mediasharex_Manager_MediaStore();
        
		$store->setMainmedia($this->_item->getId());
		
        return $store->getAll();
    }

	    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function setOriginalPreview($original)
    {
        if (!$original) {
            return false;
        }
		
		//$this->original->set($original);
		
		$previewManager = new Mediasharex_Manager_MediaStoreItem(null,$original);        
		$savedOriginal = $previewManager->save();
		
		if (!$savedOriginal){
		return false;				
		}
		
		$this->_item->setOriginal($savedOriginal['id']);
 
		return true;
    }
	
	    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function	postUpdateOriginalPreview($mediaitem)
    {
        if (!$mediaitem) {
            return false;
        }    	
	$previewManager = new Mediasharex_Manager_MediaStoreItem($this->_item->getOriginal()); 			
		$original = $previewManager->getItem();			
		$original->setMainitem($mediaitem);	
	$previewManager->save();	
		
    }

	public function save()
	{
		
	   $item = $this->_item->toArray();
	   
	   if($item['id'] > 0){
       return DBUtil::updateObject($item, $this->table);		   	
	   }else{
       return DBUtil::insertObject($item, $this->table);		   	
	   }	
	}	

}
