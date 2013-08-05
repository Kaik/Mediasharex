<?php
/**
 */
function smarty_function_album($params, $view)
{


    $data       = isset($params['data']) ? $params['data'] : false;
    $preview 	 = isset($params['preview']) ? $params['preview'] : false;
    $url 	 = isset($params['url']) ? $params['url'] : false;
	//override defaults and previews
    $width       = isset($params['width']) ? $params['width'] : false;
    $height       = isset($params['height']) ? $params['height'] : false;
	
    $richmedia       = isset($params['richmedia']) ? $params['richmedia'] : false;	
  
    $class       = isset($params['class']) ? $params['class'] : null;
    $style       = isset($params['style']) ? $params['style'] : null;
    $onclick     = isset($params['onclick']) ? $params['onclick'] : null;
    $onmousedown = isset($params['onmousedown']) ? $params['onmousedown'] : null;


		//manage override
		if($width){
		$out_width = $width;			
		}elseif($preview['width'] !== ''){
		$out_width = $preview['width'];									
		}else{			
		//safe defs
		$out_width = 100;						
		}
		if($height){
		$out_height = $height;				
		}else if($preview['height'] !== ''){
		$out_height = $preview['height'];			
		}else {					
		$out_height = 100;					
		}		
		if($richmedia){
		$out_richmedia = $richmedia;				
		}else if($preview['richmedia'] !== ''){
		$out_richmedia = $preview['richmedia'];			
		}else {					
		$out_richmedia = false;					
		}

		$out_width = $out_width - ($out_width * 0.1);
		$out_height = $out_height - ($out_height * 0.5);


   		//album thumbnail
    	$handlername = $data['handler'];
		$handlername = ucfirst($handlername);
		$h['handler'] = $handlername;		
        $handlerManager = new Mediasharex_Manager_MediaHandler(null,$h);		
        if ($handlerManager->exist()) {
        $handlerManager->loadfile();
        $handler = $handlerManager->loadHandler();
		$handler_html = $handler->getDisplay($data, $out_width, $out_height ,$out_richmedia, $url ,array('title' => $title, 'onclick' => $onclick, 'onmousedown' => $onmousedown, 'class' => $class, 'style' => $style));	
		}

		//$folder_height = $out_height;

        if (!$handler_html) {
		$handler_html = '
		<a href="'.$url.'" class="tip" "'.$data['title'].'">
		<div style="width:100%;height:'.$folder_height.'px;"> </div>		
		</a>
		'; 			
		}		
		
		$out  = $handler_html;
		
		return $out;

}

