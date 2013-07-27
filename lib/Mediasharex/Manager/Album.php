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

        return $this->_item->toArray();
    }
	
	
	    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function getSubAlbums()
    {
        if (!$this->_item) {
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
    public function getMainmedia()
    {
        if (!$this->_item->getMainmedia()) {
            return false;
        }
		
		$mediaManager = new Mediasharex_Manager_MediaItem($this->_item->getMainmedia());		
		
		$mediaManager->includeOriginal();
        return $mediaManager->getItemArray();
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

       return $item = DBUtil::selectObjectByID($this->table, $id, 'id', null, $permFilter);		
		
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
