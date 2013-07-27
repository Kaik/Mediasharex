<?php
/**
 * Mediasharex
 */
class Mediasharex_MediaSources_FacebookImage
{


    public function getTitle()
    {       
    return 'Mediashare Facebook image';//$this->__('Mediashare Youtube Handler');
    }	
 	public function getName()
 	{
    return 'Facebookimage';//$this->__('Mediashare Youtube Handler');  	
 	}	
 	public function getFormenctype()
 	{
    return 'text';//$this->__('Mediashare Youtube Handler');  	
 	}
	
 	public function getTemplate($preview)
 	{
    return "sources/facebookimage.tpl";
	
	}
	public function getPostData($view)
	{
		
	$plugin = $view->getPluginById($this->getName());	
				$plugin->load($view); 
				$plugin->decode($view);						
				$plugindata = $view->getValues();		
	return $data;	  	
 	}
	public function decodePostData($view)
	{
		
	$plugin = $view->getPluginById($this->getName());	
				$plugin->load($view); 
				$plugin->decode($view);						
				$plugindata = $view->getValues();		
	return $data;	  	
 	}	   

	public function getPlugin($view)
	{

		$par['id'] = $this->getName();
     	$par['maxLength'] = 100;		
		$plugin = $view->registerPlugin('Zikula_Form_Plugin_TextInput', $par);						
	return $plugin;		
	}

    
    public function getDisplay($data, $preview ,$width ,$height ,$richMedia ,$html_options)
    {		
		
		$previews = array('icons'=> array('width'  =>50,
										  'height' =>50,
										  'image'   => 'youtube.png'),
										  
						  'thumbnail'=> array('width'  =>180,
										  'height' =>180,
										  'image'   => $data['fileref']),
						  
						  'full'=> array('width'  =>425,
										  'height' =>350,
										  'image'   => $data['fileref'])										  
										  
										  
										  );			

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
        return $out;	
		
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
