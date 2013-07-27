<?php
/**
 * Mediasharex
 */
class Mediasharex_Manager_MediaStore
{
	
	private $tables;
	private $table;			
	private $columns;
	private $orderby;
	private $page;
	private $items;		
	private $catFilter;
	private	$permFilter;
	private $whereclause;	
	private $where;
	
	
	public function	__construct()
	{
	  // Get database setup
        $this->tables = DBUtil::getTables();
		$this->table = 'mediasharex_mediastore';
        $this->columns = $this->tables['mediasharex_mediastore_column'];		
		
		$this->setPage();
		$this->setItems();		
		$this->setpermFilter();
					
	}
		

	public function setOrderby($sortby = 'id',$sortorder = 'ASC')
	{
        $this->orderby = 'ORDER BY '.$this->columns[$sortby];
		$this->orderby .= ' '.strtoupper($sortorder);
	}	

	public function setpermFilter()
	{

        $this->permFilter[] = array('component_left'   => 'Mediasharex',
                              'component_middle' => '',
                              'component_right'  => '',
                              'instance_left'    => 'modname',
                              'instance_middle'  => 'objectid',
                              'instance_right'   => 'id',
                              'level'            => ACCESS_READ);		

	}

	public function setPage($page = -1)
	{	
		$this->page = $page;
	}

	public function setItems($items = 25)
	{	
		$this->items = $items;
	}
	
	public function getWhere()
	{
        if (!empty($this->whereclause)) {
        $this->where = 'WHERE ' . implode(' AND ', $this->whereclause);
        }else {
        $this->where = '';	
		}	
	}
	
	public function getCount()
	{
	 $this->getWhere();	    	
     $ObjArray = DBUtil::selectObjectCount($this->table, $this->where, '1' , false, $this->catFilter);	
	  return $ObjArray;	
	}	
	
	public function getAll()
	{
	  $this->getWhere();	    	
      $ObjArray = DBUtil::selectObjectArray($this->table, $this->where, $this->orderby, $this->page, $this->items,'', $this->permFilter, $this->catFilter);	
	  return $ObjArray;	
	}

	public function getPager()
    {
        return array(
            'itemsperpage' => $this->items,
            'numitems' => $this->getCount()
        );
    }	
		
}