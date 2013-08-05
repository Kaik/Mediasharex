<?php
/**
 * Mediasharex
 */
class Mediasharex_MediaSources_Youtube
{


    public function getTitle()
    {       
    return 'Mediashare Youtube Source';//$this->__('Mediashare Youtube Handler');
    }	
 	public function getName()
 	{
    return 'Youtube';//$this->__('Mediashare Youtube Handler');  	
 	}	
 	public function getFormenctype()
 	{
    return 'text';//$this->__('Mediashare Youtube Handler');  	
 	}
	
 	public function getTemplate($preview)
 	{
 		
    $templates = array('add'=> 'sources/youtube.tpl',									  
					  'post'=> 'sources/youtube_post.tpl');	
		
		
		
    return $templates[$preview];  	
 	}
	
	public function getPluginSettings()
	{
		//@ Zikula_Form_Plugin_UploadInput
		$settings['id'] = $this->getName();
     	$settings['maxLength'] = '100';
		$settings['width'] = '300px';		
		//$settings['width'] = '';
		//$settings['height'] = '';
     	//$settings['inputName'] = '';
     	//$settings['readOnly'] = '';
     	$settings['cssClass'] = 'mediasharex_source_text_field';
    	//$settings['dataField'] = ;
     	//$settings['dataBased'] = ;
     	//$settings['group'] = ;
     	//$settings['isValid'] = ;
     	//$settings['mandatory'] = ;
     	//$settings['errorMessage'] = ;
     	//$settings['myLabel'] = ;	
									
	return $settings;		
	}	
	public function getPlugin($view)
	{
		$plugin = $view->registerPlugin('Zikula_Form_Plugin_TextInput', $this->getPluginSettings());											
		return $plugin;		
	}	
	
	public function getPostData($fileinfo)
	{		
					
		$pre_item = $this->getFileInfo($fileinfo);	//pre save
	
		$odata['pre_media'] = $pre_item;
		$odata['pre_media']['fileref'] = $fileinfo;
		$odata['pre_media']['previewname'] = 'original';
		$odata['pre_media']['mimetype'] = 'video/youtubecode';		
		$odata['pre_media']['handler'] = $this->getName();
	 
	  return $odata;	  	
 	}
	
	
	public function getFileInfo($edata)
	{
		
	$v = $this->getyoutubeid($edata);	
	$odata = $this->mediasharemediaYoutubeXmlInfo($v);		
	
	return $odata;	  	
 	}

    public function getDisplay($data, $preview ,$width ,$height ,$richMedia ,$html_options)
    {		
		
		$previews = array('add'=> array('width'  =>50,
										  'height' =>50,
										  'image'   => 'youtube.png'),
										  
						  'post'=> array('width'  =>480,
										 'height' =>380,
										 'image'   => $data['fileref']));			

		//manage previews
		if(isset($previews[$preview])){
			
		$fileref = $previews[$preview]['image'];
		
		$out['width'] = $previews[$preview]['width'];
		$out['height'] = $previews[$preview]['height'];
		$out['fileref'] = $data['fileref'];			
		
		}

		//manage override
		if($width){
		$out['width'] = $width;
		$out['fileref'] = $data['fileref'];					
		}

		if($height){
		$out['height'] = $height;
		$out['fileref'] = $data['fileref'];				
		}

		$out['data']= $data;
		$out['html_options'] = $html_options;
		$out['richMedia'] = $richMedia;
		if($preview == 'post'){
		$out['html'] = $this->getHtml($data, $fileref,$out_width,$out_height,$richMedia,$html_options);
		}	
			
        return $out;	
		
		}

    public function getHtml($data,$fileref,$width ,$height ,$richMedia ,$html_options)
	{
		
		
		if ($richMedia){

		$theData = $this->getyoutubeid($fileref);		
			
		$out_html='<object width="'.$width.'" height="'.$height.'">
					 <param name="movie" value="https://www.youtube.com/v/'.$theData.'"></param>
					 <param name="wmode" value="transparent"></param>
					<param name="allowFullScreen" value="true"></param>
					<param name="allowScriptAccess" value="always"></param>					 
					 <embed src="https://www.youtube.com/v/'.$theData.'"
           type="application/x-shockwave-flash"
           wmode="transparent" width="'.$width.'" height="'.$height.'" />
           </object>';
		   		
			
		}else{
			
			
		$out_html ='<span class="tip" title="'.$title.'">
			  <i class="icon-youtube icon-3x"></i>
  			 </span>
  			 <p class="tip" title="'.$title.'">
  			 '.$title.'
  			 </p>';       				
			
		}      
       
       return $out_html;

    }

    public function mediasharemediaYoutubeXmlInfo($v)
    {

	$xml = 'http://gdata.youtube.com/feeds/api/videos/'.$v.'';
	$content = simplexml_load_file($xml);	

	$video['title'] = (string)$content->title;
	$video['description'] = (string)$content->content;

	$media = $content->children('http://search.yahoo.com/mrss/');
	$attr1 = $media->group->thumbnail[0]->attributes();
	$video['thumbnail']  = (string)$attr1['url']; // thumbnail url

	$yt   = $media->children('http://gdata.youtube.com/schemas/2007');
	$attr2 = $yt->duration->attributes();
	$length  = $attr2['seconds']; // in seconds
	$video_duration = round($length/60,2); // in minutes

	return $video;
	}



	public	function getyoutubevideocode($url)
	{
	$fh = fopen($url, 'r');
	$theData = fread($fh, filesize($url));
				fclose($fh);		
	return $theData;
	}

	public	function getyoutubeid($url)
	{ 
	parse_str(parse_url($url, PHP_URL_QUERY), $query); 
	$video_id = isset($query['v']) ? $query['v'] : NULL;
	
	return $video_id; 
	}
		
}
