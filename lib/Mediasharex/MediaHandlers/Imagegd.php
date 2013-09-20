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
	
	public function getInfo()
    {       
    return array('author' => 'Kaik',
                 'version' => '1.0.0',
                 'name' => $this->getTitle(),
                 'mimeTypes' => $this->getMimetype(),
                 'default_settings' => $this->getDefaultSettings()                 
				 );  	
 	
    }
	
    public function getDefaultSettings()
    {       
    return array('upload_max_size' 	=> '2M',
                 'Upload_max_files' => '10',
                 'image_engine' 	=> 'imagick',
                 'unusedOption' 	=> 'unusedValue' 
				 );  	
 	
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
	
	// to remove	
 	public function getFiletype()
 	{
	return 'you'; 	
 	}
	// to remove	
 	public function getFoundmimetype()
 	{
	return 'video/youtube'; 	
 	}
	// to remove
 	public function getFoundfiletype()
 	{
	return 'you'; 	
 	}	
	
		
    public function getDisplay($data, $width ,$height, $richmedia,$url ,$html_options)
    {		

		//var_dump($preview);
		//exit();	
				
		if ($data['fileref'] == ''){			
		return false;
		}

		$fileref = $data['fileref'];	
		
		
		$MediaDir = ModUtil::getVar('Mediasharex','general_mediaDirName',false);

		$filepath = $MediaDir.'/'.$fileref;   // /blank_avatar.png;//

		
    	$preset_name = 'Mediasharex_handler_imagegd_'.$width;
    	$preset_data = array(
        'width' => $width,
        'height' => $height,
       	'mode' => 'outset',
       	'__module' => 'Mediasharex'
    	);
 
    	$preset = new SystemPlugin_Imagine_Preset($preset_name, $preset_data);
		
		//var_dump($preset);
		//exit(0);
		
		$manager = ServiceUtil::getManager()->getService('systemplugin.imagine.manager');
		$imagine = new \Imagine\Imagick\Imagine();	
		$manager->setImagine($imagine);			
		$manager->setPreset($preset);		
		//$test = $manager->getPreset();
		//var_dump($test);
		//exit(0);		 
		//$image = $imagine->open($filepath);				
		//$size  = new Imagine\Image\Box($width, $height);
		//$image->resize($size);						
		//$tmpDir = $manager->getThumbDir();
	
    	$file_tmb = $manager->getThumb($filepath);
		//$file_tmb  = 'mediashare/test/text.jpg';

		//var_dump($file_tmb);
		//exit(0);		
		
		//$image->save($file_tmb);    	
    	

		$out_html = $this->getHtml($data,$url,$file_tmb,$width,$height,$richmedia,$html_options);
     
        return $out_html;	
		
		}


    public function getHtml($data,$url,$fileref,$width ,$height ,$richMedia ,$html_options)
	{
		if($url == ''){
		$url = ModUtil::url('Mediasharex','user','display', array('album'=>$data['parentalbum'],'media'=>$data['id']));
		}		
		
		$out_html = '<a href="'.$url.'" class="tip" title="'.$data['title'].'"> <img width="'.$width.'" height="'.$height.'"  src="'.$fileref.'"/></a>'; 	
				
       
       
       return $out_html;
		
    }



		
}
