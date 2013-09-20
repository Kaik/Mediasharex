<?php
/**
 * Mediasharex
 */
class Mediasharex_Manager_MediaItems
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
		$this->table = 'mediasharex_media';
        $this->columns = $this->tables['mediasharex_media_column'];		
		
		//$this->setOrderby();
		$this->setPage();
		$this->setItems();		
		$this->setcatFilter();
		$this->setpermFilter();
					
	}
	
	public function setAuthor($author = -1)
	{	
        if ((isset($author) && $author != -1) ? $author : false ) {                  
        $author = DataUtil::formatForStore($author);
        $this->whereclause[] = "tbl.".$this->columns['author']."= $author";
        }	
    }
	public function setParentalbum($parentalbum = -1)
	{	                 
        $parentalbum = DataUtil::formatForStore($parentalbum);
        $this->whereclause[] = "tbl.".$this->columns['parentalbum']."= $parentalbum";	
    }		
	public function setAccesslevel($accesslevel = -1)
	{	                 
        $accesslevel = DataUtil::formatForStore($accesslevel);
        $this->whereclause[] = "tbl.".$this->columns['accesslevel']."= $accesslevel";	
    }
	public function setViewkey($viewkey = -1)
	{	                 
        $viewkey = DataUtil::formatForStore($viewkey);
        $this->whereclause[] = "tbl.".$this->columns['viewkey']."= $viewkey";	
    }
	public function setTemplate($template = -1)
	{	                 
        $template = DataUtil::formatForStore($template);
        $this->whereclause[] = "tbl.".$this->columns['template']."= $template";	
    }
	public function setReferenceid($referenceid = -1)
	{	                 
        $referenceid = DataUtil::formatForStore($referenceid);
        $this->whereclause[] = "tbl.".$this->columns['referenceid']."= $referenceid";	
    }
	public function setOrderby($sortby = 'id',$sortorder = 'ASC')
	{
        $this->orderby = 'ORDER BY '.$this->columns[$sortby];
		$this->orderby .= ' '.strtoupper($sortorder);
	}	

	public function setcatFilter($cat = false)
	{
        if ($cat !== false){
        $this->catFilter['Cat'] = $cat;                  
        }else{
		$this->catFilter = null;	
        }

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
	 
	  $join[] = array(
	   'join_table' => 'mediasharex_mediastore',
       'join_field' => array('fileref','mimetype','width','height','bytes'),
       'object_field_name' => array('fileref','mimetype','width','height','bytes'),
       'compare_field_table' => 'original',
       'compare_field_join' => 'id',
       );  

	  $join[] = array(
	   'join_table' => 'mediasharex_albums',
       'join_field' => array('title'),
       'object_field_name' => array('album_title'),
       'compare_field_table' => 'parentalbum',
       'compare_field_join' => 'id',
       );	  
	  	    	
      $ObjArray = DBUtil::selectExpandedObjectArray($this->table, $join ,$this->where, $this->orderby, $this->page, $this->items,'', $this->permFilter, $this->catFilter);	
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