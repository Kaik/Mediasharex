<?php
/**
 * Mediasharex
 */
class Mediasharex_Manager_MediaSources
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
		$this->table = 'mediasharex_sources';
        $this->columns = $this->tables['mediasharex_sources_column'];		
		
		$this->setOrderby();
		$this->setPage(-1);
		$this->setItems(25);
		$this->setActive(1);			
	}	

	public function setOrderby($sortby = 'id',$sortorder = 'ASC')
	{
        $this->orderby = 'ORDER BY '.$this->columns[$sortby];
		$this->orderby .= ' '.strtoupper($sortorder);
	}	


	public function setPage($page = -1)
	{	
		$this->page = $page;
	}

	public function setActive($active = 1)
	{                 
        $active = DataUtil::formatForStore($active);
        $this->whereclause[] = $this->columns['active']."= $active";	
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
	
		public function getSourcesDir()
    {
    	
	     // Check access
	    if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
	        return LogUtil::registerPermissionError();
	    }
	 
	    // Clear existing handler table
	   // if (!DBUtil::truncateTable('mediashare_mediahandlers')) {
	    //    return LogUtil::registerError(__f('Error in %1$s: %2$s.', array('mediahandlerapi.scanMediaHandlers', __f("Could not clear the '%s' table.", 'mediahandlers', $dom)), $dom));
	   // }
	
	    // Scan for handlers APIs
	    $files = FileUtil::getFiles('modules/Mediasharex/lib/Mediasharex/MediaSources', false, true, 'php', 'f');
	    
		$sources = array();
	    foreach ($files as $key => $file)
	    {	
	       $sources[$key]['name'] = FileUtil::stripExtension($file);
	       $sourceManager = new Mediasharex_Manager_MediaSource(null,$sources[$key]);
	       $sources[$key]['exist']  = $sourceManager->exist();		   
		   $sourceManager->loadfile();
		   $sourceinfo = $sourceManager->getItemArray();
		   $sources[$key] = array_merge($sources[$key],$sourceinfo);
	    }
	
      return $sources;
	
	}
    	
	public function reloadsources()
    {
    	
	     // Check access
	    if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
	        return LogUtil::registerPermissionError();
	    }
		
	    // Clear existing handler table
	    if (!DBUtil::truncateTable($this->table)) {
	        return false;
	    }
		
		$foundsources = $this->getSourcesDir();
		
		foreach($foundsources as $source){
		if($source['exist']){
	    $sourceManager = new Mediasharex_Manager_MediaSource(null,$source);
		$sourceManager->loadfile();
		$source = $sourceManager->getItem();
		$source->setActive(1);	
		$sourceManager->save();			

		}
		}
      return true;
	
	}	
		
}
