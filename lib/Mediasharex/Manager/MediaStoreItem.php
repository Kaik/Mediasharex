<?php
/**
 * Mediasharex
 */
class Mediasharex_Manager_MediaStoreItem
{

    private $_item;

    private $tables;
    private $table;
    private $columns;


    /**
     * construct
     */
    public function __construct($id = null, $item = null)
    {
	  // Get database setup
        $this->tables = DBUtil::getTables();
		$this->table = 'mediasharex_mediastore';
        $this->columns = $this->tables['mediasharex_mediastore_column'];	

        $this->_item = new Mediasharex_Base_MediaStoreItem();

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
