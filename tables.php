<?php
/**
 * Mediasharex
 */
 
function Mediasharex_tables()
{
	
	
    // Initialise table array
    $dbtable = array();

 // Album and media setup
    $dbtable['mediasharex_albums'] = DBUtil::getLimitedTablename('mediasharex_albums');

    $dbtable['mediasharex_albums_column'] = array(
        'id'             => 'id',
        'hitcount'       => 'hitcount',
        'author'         => 'author',
        'title'          => 'title',
        'description'    => 'description',
        'summary'        => 'summary',
        'template'       => 'template',
        'parentalbum'  	 => 'parentalbum',
        'accesslevel'    => 'accesslevel',
        'viewkey'        => 'viewkey',
        'mainmedia'      => 'mainmedia',
        'thumbnailsize'  => 'thumbnailsize',
        'nestedsetleft'  => 'nestedsetleft',
        'nestedsetright' => 'nestedsetright',
        'nestedsetlevel' => 'nestedsetlevel',
        'extappurl'      => 'extappurl',
        'extappdata'     => 'extappdata',
        'referenceid'    => 'referenceid'
//        'keywords'       => 'keywords', general keywors table?__ATTRIBUTIES__
    );
	
	
	
    $dbtable['mediasharex_albums_column_def'] = array(
        'id'             => 'I NOTNULL AUTO PRIMARY',
        'hitcount'       => 'I NOTNULL',
        'author'         => 'I NOTNULL',
        'title'          => "C(255) NOTNULL DEFAULT ''",
        'description'    => "X NOTNULL DEFAULT ''",        
        'summary'        => "X NOTNULL DEFAULT ''",
        'template'       => "C(255) NOTNULL DEFAULT 'slideshow'",
        'parentalbum'	 => 'I',
        'accesslevel'    => 'I1 NOTNULL DEFAULT 0',
        'viewkey'        => 'C(32) NOTNULL',
        'mainmedia'      => 'I NOTNULL DEFAULT 0',
        'thumbnailsize'  => 'I NOTNULL',
        'nestedsetleft'  => 'I NOTNULL DEFAULT 0',
        'nestedsetright' => 'I NOTNULL DEFAULT 0',
        'nestedsetlevel' => 'I NOTNULL DEFAULT 0',
        'extappurl'      => 'C(255)',
        'extappdata'     => 'C(512)',
        'referenceid'   => "C(255) NOTNULL DEFAULT ''"
    );

    // Enable categorization services
    $dbtable['mediasharex_albums_db_extra_enable_categorization'] = true;
	// Enable attribution services
    $dbtable['mediasharex_albums_db_extra_enable_attribution'] = true; //ModUtil::getVar('Mediasharex', 'enableattribution');    
 	
    $dbtable['mediasharex_albums_primary_key_column'] = 'id';    

   // add standard data fields
    ObjectUtil::addStandardFieldsToTableDefinition ($dbtable['mediasharex_albums_column']);
    ObjectUtil::addStandardFieldsToTableDataDefinition($dbtable['mediasharex_albums_column_def']);    




	
    // Media information
    $dbtable['mediasharex_media'] = DBUtil::getLimitedTablename('mediasharex_media');

    $dbtable['mediasharex_media_column'] = array(
        'id'            => 'id',
        'hitcount'   	=> 'hitcount',
        'author'        => 'author',        
        'title'         => 'title',
        'description'   => 'description',
        'parentalbum' 	=> 'parentalbum',
        'position'      => 'position',
        'handler'  		=> 'handler',
        'original'    	=> 'original',
        'referenceid'   => 'referenceid'
    );
    $dbtable['mediasharex_media_column_def'] = array(
        'id'            => 'I NOTNULL AUTO PRIMARY',
        'hitcount'      => 'I NOTNULL',
        'author'        => 'I NOTNULL',
        'title'         => "C(255) NOTNULL DEFAULT ''",
        'description'   => "X NOTNULL DEFAULT ''",
        'parentalbum' 	=> 'I NOTNULL',
        'position'      => 'I NOTNULL',
        'handler'  		=> 'C(50) NOTNULL',
        'original'      => 'I NOTNULL',
        'referenceid'   => "C(255) NOTNULL DEFAULT ''"
    );


    // Enable categorization services
    $dbtable['mediasharex_media_db_extra_enable_categorization'] = true;
	// Enable attribution services
    $dbtable['mediasharex_media_db_extra_enable_attribution'] = true; //ModUtil::getVar('Mediasharex', 'enableattribution');    
 	
    $dbtable['mediasharex_media_primary_key_column'] = 'id';    

   // add standard data fields
    ObjectUtil::addStandardFieldsToTableDefinition ($dbtable['mediasharex_media_column']);
    ObjectUtil::addStandardFieldsToTableDataDefinition($dbtable['mediasharex_media_column_def']);    

    // Media storage (image information)
    $dbtable['mediasharex_mediastore'] = DBUtil::getLimitedTablename('mediasharex_mediastore');

    $dbtable['mediasharex_mediastore_column'] = array(
        'id'       		=> 'id',
        'mediaitem'		=> 'mediaitem',
        'previewname'  	=> 'previewname',
        'fileref'  		=> 'fileref',
        'mimetype' 		=> 'mimetype',
        'width'    		=> 'width',
        'height'   		=> 'height',
        'bytes'    		=> 'bytes'
    );
    $dbtable['mediasharex_mediastore_column_def'] = array(
        'id'       		=> 'I NOTNULL AUTO PRIMARY',
        'mediaitem'		=> 'I NOTNULL',
        'previewname'  	=> 'C(100) NOTNULL',
        'fileref'  		=> 'C(300) NOTNULL',
        'mimetype' 		=> 'C(100) NOTNULL',
        'width'    		=> 'I2 NOTNULL',
        'height'   		=> 'I2 NOTNULL',
        'bytes'    		=> 'I NOTNULL'
    );


    // Media DB storage (image data for storing images in DB)
    $dbtable['mediasharex_mediadb'] = DBUtil::getLimitedTablename('mediasharex_mediadb');

    $dbtable['mediasharex_mediadb_column'] = array(
        'id'      => 'id',
        'fileref' => 'ref',
        'mode'    => 'mode',
        'type'    => 'type',
        'bytes'   => 'bytes',
        'data'    => 'data'
    );
    $dbtable['mediasharex_mediadb_column_def'] = array(
        'id'      => 'I NOTNULL AUTO PRIMARY',
        'fileref' => 'C(50) NOTNULL',
        'mode'    => 'C(20) NOTNULL',
        'type'    => 'C(10) NOTNULL',
        'bytes'   => 'I NOTNULL',
        'data'    => 'B NOTNULL'
    );
 

    // Media handlers
    $dbtable['mediasharex_mediahandlers'] = DBUtil::getLimitedTablename('mediasharex_mediahandlers');

    $dbtable['mediasharex_mediahandlers_column'] = array(
      'id'            => 'id',
      'mimetype'      => 'mimetype',
      'filetype'      => 'filetype',
      'foundmimetype' => 'foundmimetype',
      'foundfiletype' => 'foundfiletype',
      'handler'       => 'handler',
      'title'         => 'title',
      'active'        => 'active'
    );
    $dbtable['mediasharex_mediahandlers_column_def'] = array(
      'id'            => 'I NOTNULL AUTO PRIMARY',
      'mimetype'      => 'C(50)',
      'filetype'      => 'C(10)',
      'foundmimetype' => 'C(50) NOTNULL',
      'foundfiletype' => 'C(50) NOTNULL',
      'handler'       => 'C(50) NOTNULL',
      'title'         => "C(50) NOTNULL DEFAULT ''",
      'active'        => 'I1 NOTNULL DEFAULT 1'
    );
	
    // Sources
    $dbtable['mediasharex_sources'] = DBUtil::getLimitedTablename('mediasharex_sources');

    $dbtable['mediasharex_sources_column'] = array(
        'id'          => 'id',
        'name'        => 'name',
        'title'       => 'title',
        'formenctype' => 'formenctype',
        'active'      => 'active'
    );
    $dbtable['mediasharex_sources_column_def'] = array(
        'id'          => 'I NOTNULL AUTO PRIMARY',
        'name'        => 'C(50) NOTNULL',
        'title'       => "C(50) NOTNULL DEFAULT ''",
        'formenctype' => "C(50) NOTNULL DEFAULT 'multipart/form-data'",
        'active'      => 'I1 NOTNULL DEFAULT 1'
    );

 
    // Keyword handling
    $dbtable['mediasharex_keywords'] = DBUtil::getLimitedTablename('mediasharex_keywords');

    $dbtable['mediasharex_keywords_column'] = array(
        'id'  		=> 'id',
        'item' 		=> 'item',
        'type'    	=> 'type',
        'keyword' 	=> 'keyword'
    );
    $dbtable['mediasharex_keywords_column_def'] = array(
        'id'  		=> 'I NOTNULL AUTO PRIMARY',
        'item' 	    => 'I NOTNULL',
        'type'    	=> 'C(5) NOTNULL',
        'keyword' 	=> 'C(50) NOTNULL'
    );
    $dbtable['mediasharex_keywords_column_idx'] = array('keywordIdx' => array('keyword'));
 
    // Access table setup
    $dbtable['mediasharex_access'] = DBUtil::getLimitedTablename('mediasharex_access');

    $dbtable['mediasharex_access_column'] = array(
        'id'       => 'id',       // Unique ID
        'albumid'    => 'albumid',  // album ID for which access applies
        'groupid'    => 'groupid',  // (user) group ID for which access applies
        'access'   => 'access'    // access type
    );
    $dbtable['mediasharex_access_column_def'] = array(
        'id'       => 'I NOTNULL AUTO PRIMARY',
        'albumid'    => 'I NOTNULL',
        'groupid'    => 'I NOTNULL',
        'access'   => 'I NOTNULL'
    );
    $dbtable['mediasharex_access_column_idx'] = array('albumidIdx' => array('albumid'));



    // Invitations table
    $dbtable['mediasharex_invitation'] = DBUtil::getLimitedTablename('mediasharex_invitation');

    $dbtable['mediasharex_invitation_column'] = array(
        'id'         => 'id',
        'created'    => 'created',
        'album'    	 => 'albumId',
        'key'        => 'viewkey',
        'hitcount'   => 'viewcount',
        'email'      => 'email',
        'subject'    => 'subject',
        'text'       => 'text',
        'sender'     => 'sender',
        'expires'    => 'expires'
    );
    $dbtable['mediasharex_invitation_column_def'] = array(
        'id'         => 'I NOTNULL AUTO PRIMARY',
        'created'    => 'T NOTNULL',
        'album'      => 'I NOTNULL',
        'key'        => "C(20) NOTNULL DEFAULT ''",
        'hitcount'   => 'I NOTNULL DEFAULT 0',
        'email'      => "C(100) NOTNULL DEFAULT ''",
        'subject'    => "C(255) NOTNULL DEFAULT ''",
        'text'       => "X NOTNULL DEFAULT ''",
        'sender'     => "C(50) NOTNULL DEFAULT ''",
        'expires'    => 'T'
    );
	

	$settings = ModUtil::getVar('Mediasharex','import_enableImportTables',false);
	//import old mediashare tables
	if ($settings){
	$importtables = ModUtil::apiFunc('Mediasharex', 'import', 'include_import_tables');
	$dbtable = array_merge($dbtable, $importtables);	
	}

	//var_dump($dbtable);
	//exit(0);
 
    return $dbtable;
}
