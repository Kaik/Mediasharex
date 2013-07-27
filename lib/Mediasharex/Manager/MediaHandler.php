<?php
/**
 * Mediasharex
 */
class Mediasharex_Manager_MediaHandler
{

    private $_item;

    private $tables;
    private $table;
    private $columns;
	
	private $handlerClass;	

	private $handler;
	
	public $mimetype;
	
    /**
     * construct
     */
    public function __construct($id = null, $item = null)
    {
	  // Get database setup
        $this->tables = DBUtil::getTables();
		$this->table = 'mediasharex_mediahandlers';
        $this->columns = $this->tables['mediasharex_mediahandlers_column'];	

        $this->_item = new Mediasharex_Base_MediaHandler();

        if (isset($item)) {
            $this->_item->set($item);
        } elseif ($id > 0) {
            $this->_item->set($this->_getFromDB($id));
        }	
		if($this->_item->getHandler()){		
    	$this->setHandlerClass();						
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
    public function includeStoreItem()
    {
        if (!$this->_item) {
            return false;
        }
		
		//$item = $this->getItemArray();
		
		//$store = new Mediasharex_Manager_MediaStoreItem();
        //$this->_item['store'] = $store->getItemArray();
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

    public function setHandlerClass()
	{
	  if($this->_item->getHandler()){			
		$this->handlerClass = 'Mediasharex_MediaHandlers_'.$this->_item->getHandler();
	  }else{
	  	$this->handlerClass = false;
	  }			
	}
    public function exist()
	{
		$this->setHandlerClass();
		   
	   if($this->_item->getHandler()){	      	
       return class_exists($this->handlerClass);		   	
	   }else{
       return false;		   	
	   }	
	}
	
    public function loadfile()
	{  
	   if($this->exist()){
	   
	   $handlerClass = $this->handlerClass;	
	   $this->handler = new $handlerClass();
	   $title =  $this->handler->getTitle();   
	   $this->_item->setTitle($title);
	   
	   $this->mimetype = $this->handler->getMimetype();
	   
	   return true;			   		   	
	   }else{
	   return false;	   			   		   	
	   }	
	}
	
    public function loadHandler()
	{  	   	
	   return $this->handler;	 	
	}
    			

}
