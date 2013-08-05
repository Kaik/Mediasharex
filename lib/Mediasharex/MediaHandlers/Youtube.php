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
		
		
    public function getDisplay($data, $width, $height, $richmedia, $html_options)
    {		
		$fileref = $data['fileref'];			
		
		$out_html = $this->getHtml($data, $fileref, $width, $height, $richmedia, $html_options);
     
        return $out_html;	
		
		}


    public function getHtml($data, $fileref, $width, $height, $richmedia, $html_options)
	{
		
		
		if ($richmedia){

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
