<?php
/**
 * Mediasharex
 */
class Mediasharex_MediaHandlers_Imagegd
{

    public function getTitle()
    {       
    return 'ImageGD';//$this->__('Mediashare Youtube Handler');
    }	
 	public function getMimetype()
 	{
	return array(
            array('mimetype' => 'image/pjpeg',
                  'filetype' => 'jpg',
                  'foundmimetype' => 'image/jpeg',
                  'foundfiletype' => 'jpg'),
            array('mimetype' => 'image/jpeg',
                  'filetype' => 'jpeg',
                  'foundmimetype' => 'image/jpeg',
                  'foundfiletype' => 'jpg'),
            array('mimetype' => 'image/png',
                  'filetype' => 'png',
                  'foundmimetype' => 'image/png',
                  'foundfiletype' => 'png'),
            array('mimetype' => 'image/gif',
                  'filetype' => 'gif',
                  'foundmimetype' => 'image/gif',
                  'foundfiletype' => 'gif'));  	
 	}	
 	public function getFiletype()
 	{
	return 'you'; 	
 	}
 	public function getFoundmimetype()
 	{
	return 'video/youtube'; 	
 	}
 	public function getFoundfiletype()
 	{
	return 'you'; 	
 	}	
	
		
    public function getDisplay($data, $preview ,$width ,$height, $richMedia,$url ,$html_options)
    {		
		
		$previews = array('icons'=> array('width'  =>50,
										  'height' =>50,
										  'image'   => 'imagegd.png'),
										  
						  'thumbnail'=> array('width'  =>180,
										  'height' =>180,
										  'image'   => $data['fileref']),										  
						  'full'=> array('width'  =>780,
										  'height' =>780,
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
		
		
		$out_html = $this->getHtml($data,$url,$fileref,$out_width,$out_height,$richMedia,$html_options);
     
        return $out_html;	
		
		}


    public function getHtml($data,$url,$fileref,$width ,$height ,$richMedia ,$html_options)
	{
		if($url == ''){
		$url = ModUtil::url('Mediasharex','user','display', array('album'=>$data['parentalbum'],'media'=>$data['id']));
		}		
		$MediaDir = ModUtil::getVar('Mediasharex','mediaDirName',false);
		
			
		$out_html = '<a href="'.$url.'" class="tip" "'.$data['title'].'">  <img  src="'.$MediaDir.'/'.$fileref.'"  width="'.$width.'" height="'.$height.'"  /></a>'; 	
				
       
       
       return $out_html;
		
    }



		
}
