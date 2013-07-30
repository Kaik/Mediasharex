<?php
/**
 * Mediasharex
 */
class Mediasharex_Manager_Album
{

    private $_item;

    private $tables;
    private $table;
    private $columns;

    private $subalbums;
	private $items;
	
	private $mainmedia;
	private $original;		
	
    /**
     * construct
     */
    public function __construct($id = null, $item = null)
    {
	  // Get database setup
        $this->tables = DBUtil::getTables();
		$this->table = 'mediasharex_albums';
        $this->columns = $this->tables['mediasharex_albums_column'];	

        $this->_item = new Mediasharex_Base_Album();
        $this->mainmedia = new Mediasharex_Base_MediaItem();
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
		$this->getThemeCheck();
		
		$mediaItemFull = array_merge($this->mainmedia->toArray(),$this->original->toArray());
		
		$out = array_merge($mediaItemFull,$this->_item->toArray());		
		
        return $out;
    }
	
	
	    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function getSubAlbums()
    {
        if (!$this->_item->getId()) {
            return false;
        }
		
		$item = $this->getItemArray();
		
		$subalbums = new Mediasharex_Manager_Albums();
		
		$subalbums->setParentalbum($item['id']);
		
        return $subalbums->getAll();
    }

	    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function getThemeCheck()
    {
        if ($this->_item->getTemplate() == '') {
            $this->_item->setTemplate('standard');
        }
		
    }	
	
	    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function getMediaItems()
    {
        if (!$this->_item->getId()) {
            return false;
        }
		
		$mediaManager = new Mediasharex_Manager_MediaItems();		
		$mediaManager->setParentalbum($this->_item->getId());
		
        return $mediaManager->getAll();
    }	

    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function includeMainmedia()
    {
        if (!$this->_item->getMainmedia()) {
            return false;
        }
		
		//$this->original = 
		
		//$media = new Mediasharex_Manager_MediaItem($this->_item->getMainmedia());
        //$media->includeOriginal();
        //$this->_item->setMainmedia($media->getItemArray());
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
	   'join_table' => 'mediasharex_media',
       'join_field' => array('original','handler'),
       'object_field_name' => array('original','handler'),
       'compare_field_table' => 'mainmedia',
       'compare_field_join' => 'id',
       );  	
	  $join[] = array(
	   'join_table' => 'mediasharex_mediastore',
       'join_field' => array('fileref','mimetype','width','height','bytes'),
       'object_field_name' => array('fileref','mimetype','width','height','bytes'),
       'compare_field_table' => 'a.original',
       'compare_field_join' => 'id',
       ); 	   
	   					  

        $item = DBUtil::selectExpandedObjectByID($this->table, $join, $id, 'id', null, $permFilter);		
		
		$this->mainmedia->set($item);
		$this->original->set($item);
		return $item;
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
