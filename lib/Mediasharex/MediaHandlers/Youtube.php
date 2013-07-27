<?php
/**
 * Mediasharex
 */
class Mediasharex_MediaHandlers_Youtube
{

    public function getTitle()
    {       
    return 'Mediashare Youtube Handler';//$this->__('Mediashare Youtube Handler');
    }	
 	public function getMimetype()
 	{
		return array(
            array('mimetype' => 'video/youtube',
                  'filetype' => 'you',
                  'foundmimetype' => 'video/youtube',
                  'foundfiletype' => 'you'));  	
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
			
		$out_width = $previews[$preview]['width'];	
		$out_height = $previews[$preview]['height'];	
		$fileref = $previews[$preview]['image'];
		}

		//manage override
		if($width){
		$out_width = $width;
		$fileref = $data['fileref'];				
		}

		if($height){
		$out_height = $height;
		$fileref = $data['fileref'];				
		}
		
		
		$out_html = $this->getHtml($data, $fileref,$out_width,$out_height,$richMedia,$html_options);
     
        return $out_html;	
		
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
