<?php
/**
 * Mediasharex
 */
class Mediasharex_MediaSources_AnyFileUpload
{


    public function getTitle()
    {       
    return 'Mediashare File Source';//$this->__('Mediashare Youtube Handler');
    }	
 	public function getName()
 	{
    return 'AnyFileUpload';//$this->__('Mediashare Youtube Handler');  	
 	}	
 	public function getFormenctype()
 	{
    return 'usused';//$this->__('Mediashare Youtube Handler');  	
 	}	
	public function getTemplate($preview)
 	{
    return "sources/fileupload.tpl"; //"sources/fileupload_'".$preview."'.tpl";//$this->__('Mediashare Youtube Handler');  	
 	}
	public function getPluginSettings()
	{
		//@ Zikula_Form_Plugin_UploadInput
		$settings['id'] = $this->getName();
     	$settings['maxLength'] = '100';
		//$settings['width'] = '';
		//$settings['height'] = '';
     	//$settings['inputName'] = '';
     	//$settings['readOnly'] = '';
     	$settings['cssClass'] = 'mediasharex_source_upload_field';
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
		$plugin = $view->registerPlugin('Zikula_Form_Plugin_UploadInput', $this->getPluginSettings());						
		return $plugin;		
	}	

	public function getPostData($view)
	{
			
	return $data;	  	
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
		
}
