<?php
/**
 * Mediasharex
 */
class Mediasharex_Manager_MediaSource
{

    private $_item;

    private $tables;
    private $table;
    private $columns;
	
	private $sourceClass;	

	private $source;
	
	
    /**
     * construct
     */
    public function __construct($id = null, $item = null)
    {
	  // Get database setup
        $this->tables = DBUtil::getTables();
		$this->table = 'mediasharex_sources';
        $this->columns = $this->tables['mediasharex_sources_column'];	

        $this->_item = new Mediasharex_Base_MediaSource();

        if (isset($item)) {
            $this->_item->set($item);
        } elseif ($id > 0) {
            $this->_item->set($this->_getFromDB($id));
        }	
		if($this->_item->getName()){		
    	$this->setSourceClass();						
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
    public function readPost($data)
    {
    	
	if($this->exist()){
	 $this->loadfile();	
	 $this->loadSource();		
	 $cleandata = $this->source->getPostData($data);	
	}

	return $cleandata;
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

    public function setSourceClass()
	{
	  if($this->_item->getName()){			
		$this->sourceClass = 'Mediasharex_MediaSources_'.$this->_item->getName();
	  }else{
	  	$this->sourceClass = false;
	  }			
	}
    public function exist()
	{
	   $this->setSourceClass();
		   
	   if($this->_item->getName()){	      	
       return class_exists($this->sourceClass);		   	
	   }else{
       return false;		   	
	   }	
	}
	
    public function loadfile()
	{  
	   if($this->exist()){
	   
	   $sourceClass = $this->sourceClass;	
	   $this->source = new $sourceClass();

	   $source['name'] = (string)$this->source->getName();	
       $source['title'] = (string)$this->source->getTitle();
	   $source['formenctype'] = (string)$this->source->getFormenctype();
	
	   $this->_item->set($source);
		   	   
	   return true;			   		   	
	   }else{
	   return false;	   			   		   	
	   }	
	}
	
    public function loadSource()
	{  	   	
	   return $this->source;	 	
	}
    			

}
