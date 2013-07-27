<?php
/**
 * Mediasharex
 */
class Mediasharex_Manager_MediaHandlers
{
	
	private $tables;
	private $table;			
	private $columns;
	private $orderby;
	private $page;
	private $items;		
	private	$permFilter;
	private $whereclause;	
	private $where;	
	
	public function	__construct()
	{
	  // Get database setup
        $this->tables = DBUtil::getTables();
		$this->table = 'mediasharex_mediahandlers';
        $this->columns = $this->tables['mediasharex_mediahandlers_column'];		
		
		$this->setOrderby();
		$this->setPage(-1);
		$this->setItems(25);		
								
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
	
	public function getHandlersDir()
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
	    $files = FileUtil::getFiles('modules/Mediasharex/lib/Mediasharex/MediaHandlers', false, true, 'php', 'f');
	    
		$handlers = array();
	    foreach ($files as $key => $file)
	    {	
	       $handlers[$key]['handler'] = FileUtil::stripExtension($file);
	       $handlers[$key]['class']  = 'Mediasharex_MediaHandlers_'.$handlers[$key]['handler'];
		   $item['handler'] = $handlers[$key]['handler'];
	       $handlerManager = new Mediasharex_Manager_MediaHandler(null,$item);
	       $handlers[$key]['exist']  = $handlerManager->exist();
		   $handlerManager->loadfile();
		   $handlerinfo = $handlerManager->getItemArray();
		   $handler = $handlerManager->loadHandler();
		   $handlers[$key]['supportedMimetypes'] = $handler->getMimetype();//$handler->getMimetype();
		   $handlers[$key] = array_merge($handlers[$key],$handlerinfo);
	    }
	
      return $handlers;
	
	}
    	
	public function reloadhandlers()
    {
    	
	     // Check access
	    if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
	        return LogUtil::registerPermissionError();
	    }
		
	    // Clear existing handler table
	    if (!DBUtil::truncateTable($this->table)) {
	        return false;
	    }
		
		$foundhandlers = $this->getHandlersDir();
		
		foreach($foundhandlers as $handler){
		if($handler['exist']){
	    $handlerManager = new Mediasharex_Manager_MediaHandler(null,$handler['handler']);
		$handlerObj = $handlerManager->getItem();
		if(is_array($handler['supportedMimetypes'])){
		foreach($handler['supportedMimetypes'] as $handlerRow){
		$handlerObj->setTitle($handler['title']);
		$handlerObj->setHandler($handler['handler']);
		$handlerObj->setMimetype($handlerRow['mimetype']);
		$handlerObj->setFiletype($handlerRow['filetype']);
		$handlerObj->setFoundmimetype($handlerRow['foundmimetype']);
		$handlerObj->setFoundfiletype($handlerRow['foundfiletype']);
		$handlerObj->setActive(1);
		$handlerManager->save();			
		}	
		}
		}
		}
      return true;
	
	}		
		
}
