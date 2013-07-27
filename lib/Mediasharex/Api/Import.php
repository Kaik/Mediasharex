<?php
/**
 * Mediasharex
 */

class Mediasharex_Api_Import extends Zikula_AbstractApi
{

	 /**
     * get installed mediashare module
     */
    public function findMediashareModule()
    {		
		$oldversion = ModUtil::getInfoFromName('Mediashare');
		if (!$oldversion){
			
		}
        return $oldversion;
    }
	
	 /**
     * get any mediashare tables
     */
    public function include_import_tables()
    {
	  		
	  $tables = $this->getCompatibititeTables();
	  $dbtables = array();
  
	  foreach ($tables as $table => $fields) {
						
		  $column = $table.'_column';
		  $column_def = $table.'_column_def';
		  $dbtables[$table] = $table;			  

		  foreach ($fields as $key => $field) {
		  //$fieldparts = split('_', $field);
		  //$fieldname = $fieldparts[1];	
		  $dbtables[$column][$field] = $field;
		  $dbtables[$column_def][$field] = $field;  	  
		  }		  
	  }	  		
			
	 return $dbtables;
	}	

	 /**
     * get tables
     */
    public function getMediasharexCompatibiliteTablesNames()
    {
	   $tables = array('mediashare_access',
	   				   'mediashare_albums',
	   				   'mediashare_invitation',
	   				   'mediashare_keywords',
	   				   'mediashare_media',
	   				   'mediashare_mediadb',
	   				   'mediashare_mediahandlers',
	   				   'mediashare_mediastore',
	   				   'mediashare_sources',
	   				   'mediashare_setup'	   				   	   				   	   				   
	   );


        return $tables;
    }
	
	 /**
     * get tables
     */
    public function getMediasharexTablesNames()
    {
	   $tables = array('access',
	   				   'albums',
	   				   'invitation',
	   				   'keywords',
	   				   'media',
	   				   'mediadb',
	   				   'mediahandlers',
	   				   'mediastore',
	   				   'sources',
	   				   'setup'	   				   	   				   	   				   
	   );


        return $tables;
    }
	
	 /**
     * get any mediashare tables
     */
    public function checkTableName($tablename)
    {
	  		
	  $mxtablesnames = $this->getMediasharexCompatibiliteTablesNames();	  
	  foreach ($mxtablesnames as $mxtablename) {
		  if (strpos($tablename, "$mxtablename") !== false){							
    	  $mtable[$mxtablename] = strpos($tablename, "$mxtablename");
		  return $mtable;	  	
		  }			  
	  }	  		
 			
	 return false;
	}	
	
	
	 /**
     * get any mediashare tables
     */
    public function getCompatibititeTables()
    {
	  		
	  $tables = Doctrine_Manager::getInstance()->getCurrentConnection()->import->listTables();  
	  $mxctables = array();
	  foreach ($tables as $key => $table) {
	  	  //no false check because we want to eliminate mediasharex tables (without prefix)	  	  
	  	  if($this->checkTableName($table)){  	  								
		  $mxctables[$table] = $this->getTableFields($table); 	  	    
		  }			  
	  }	  		
	  //$mtables = array_search('_mediashare_', $tables);		
	 ksort($mxctables); 			
	 return $mxctables;
	}
	
	 /**
     * get any mediashare tables
     */
    public function MatchCompatibititeTables()
    {
	  	
	  $mxtablesnames = $this->getMediasharexTablesNames();
	  
	   	  		
	  $tables = $this->getCompatibititeTables(); 
	  $outtables = array();
	  //works only for tables with prefix!!!
	  foreach ($mxtablesnames as $mxtablename) {
	  $outtables[$mxtablename]['fields'] = DBUtil::getColumnsArray("mediasharex_$mxtablename");
     /*** apply the lower function to the array ***/
 	  $MXfields = $outtables[$mxtablename]['fields'];
	  $MXfieldsX = array();  
	  foreach($MXfields as $keyfields => $field){
	  $MXfieldsX[$field] =	strtolower($field);  					
	  }	  
 	  $outtables[$mxtablename]['fields'] = $MXfieldsX;	  		  	
	  foreach ($tables as $key => $table) {
	  $nameparts = explode("_", $key);	
	  $partscount = count($nameparts);
	  if ($partscount >2) {
	  $prefix = $nameparts[0];
	  $mediashare = $nameparts[1];
	  $tablenamex = $nameparts[2];	  	  		  	  
	  }			
  	  if ($mxtablename == $tablenamex){
	  	
	  $tablex=array();	
	  foreach ($table as $fkey => $field) {
	  $fieldparts = explode("_", $field);
	  if(is_array($fieldparts)){
	  $partscount = count($fieldparts);	  	
	  if ($partscount >1) {
	  $prefix = $fieldparts[0];
	  $fieldx = strtolower($fieldparts[1]);	  
	  $tablex[$fieldx]['name'] = $field;
	  }else{ 
	  $tablex[$fkey] = $field;		  	
	  }	    
	  }else{
	  $tablex[$fkey] = $field;	
	  }	
	  }		
      $outtables[$mxtablename]['foundtables'][$key] = $tablex; 	    	  	
	  }
	  }			  
	  }	  		
	  //$mtables = array_search('_mediashare_', $tables);		
	 //ksort($outtables); 			
	 return $outtables;
	}	

	 /**
     * get any mediashare tables
     */
    public function getTableFields($tablename)
    {	  
		$fields = Doctrine_Manager::getInstance()->getCurrentConnection()->import->listTableColumns($tablename);  			  	   
		$tablefields = array();
		foreach ($fields as $key => $field) {
		  $tablefields[] = $field['name'];
		}
	  return $tablefields;	
	}

	 /**
	
		 /**
     * create the default category tree
     */
    public function tablesPerVersion($oldversion)
    {
	
	   $tables = array(
	   '4.1.0' =>array('mediashare_access',
	   				   'mediashare_albums',
	   				   'mediashare_invitation',
	   				   'mediashare_keywords',
	   				   'mediashare_media',
	   				   'mediashare_mediadb',
	   				   'mediashare_mediahandlers',
	   				   'mediashare_mediastore'	   				   	   				   	   				   
					   )
	   );


        return $tables[$oldversion];
    }
	
	 /**
	
		 /**
     * create the default category tree
     */
    public function import($settings)
    {	
	if(!$settings){
		return false;
	}
	
	$import_items = array();
	foreach ($settings as $mode => $tablexx) {
		foreach ($settings[$mode] as $table => $fields) {				
		$items = DBUtil::selectObjectArray($table);	
		foreach ($items as $item_key => $item) {
			foreach ($fields as $to_field => $from) {
			
			$from_parts = explode(':', $from);
			$parts_count = is_array($from_parts)? count($from_parts) : 1 ;
			//$import_items[$item_key][$to_field] = $parts_count;
						
			if($parts_count == 1){
			//field info	
			$field_name	= $from;			
			$import_items[$item_key][$to_field] = $item[$field_name];
				
			}elseif($parts_count == 2){
			$from_tablename = $from_parts[0];
			$field_name = $from_parts[1];
			
			$import_items[$item_key][$to_field] = $item[$field_name];	
				
			}elseif($parts_count == 4){
				
			$tablename_to_fetch = $from_parts[0];
			$field_to_fetch = $from_parts[1];			
			$by_id_field = $from_parts[3];			
			$search_by_field = $from_parts[2];						

			$import_obj = DBUtil::selectObjectById($tablename_to_fetch, $item[$by_id_field], $search_by_field);
			
			$import_items[$item_key][$to_field] = $import_obj[$field_to_fetch];			
			
			}

			elseif($parts_count > 4){
				
			$tablename_to_fetch = $from_parts[0];
			$field_to_fetch = $from_parts[1];
			$search_by_field[0] = $from_parts[2];						
			$by_id_field = $from_parts[3];			

			$search_by_field[1] = $from_parts[4];
			$search_by_field[2] = $from_parts[5];
				
			if ($to_field == 'mediaitem'){
				
							
			foreach ($search_by_field as $key => $externalfieldname) {

			$import_obj = DBUtil::selectObjectById($tablename_to_fetch, $item[$by_id_field], $externalfieldname);
			if($import_obj){
			$import_items[$item_key][$to_field] = $import_obj[$field_to_fetch];	
			}
				
			}
			
				
			}elseif ($to_field == 'previewname'){
			
			foreach ($search_by_field as $key => $externalfieldname) {

			$import_obj = DBUtil::selectObjectById($tablename_to_fetch, $item[$by_id_field], $externalfieldname);
			if($import_obj){
				
			if($externalfieldname == 'ms_originalid'){
			$pname = 'original';		
			$import_items[$item_key][$to_field] = $pname;	
			}elseif ($externalfieldname == 'ms_previewid'){
			$pname = 'preview';		
			$import_items[$item_key][$to_field] = $pname;					
				
			}elseif ($externalfieldname == 'ms_thumbnailid'){
			$pname = 'thumbnail';		
			$import_items[$item_key][$to_field] = $pname;					
				
			}
			
			
			}
				
			}
			}
				
			}





			
			}				
			}		
		
		
		
	//echo '<pre>';		
	//var_dump($import_items);
	//exit(0);
		$imported_items = array();
		foreach ($import_items as $ikey => $insert_item) {
		$imported_items[$ikey] = DBUtil::insertObject($insert_item,'mediasharex_'.$mode ,'id',true);
		}							
		}
	}

        return $import_items;
    }
	  
}
