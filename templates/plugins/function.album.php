<?php
/**
 */
function smarty_function_album($params, $view)
{


    $data       = isset($params['data']) ? $params['data'] : false;
    $preview 	 = isset($params['preview']) ? $params['preview'] : 'add';
    $url 	 = isset($params['url']) ? $params['url'] : false;
	//override defaults and previews
    $width       = isset($params['width']) ? $params['width'] : null;
    $height       = isset($params['height']) ? $params['height'] : null;
	
    $richMedia       = isset($params['richMedia']) ? $params['richMedia'] : false;	
  
    $class       = isset($params['class']) ? $params['class'] : null;
    $style       = isset($params['style']) ? $params['style'] : null;
    $onclick     = isset($params['onclick']) ? $params['onclick'] : null;
    $onmousedown = isset($params['onmousedown']) ? $params['onmousedown'] : null;


   	
    	$handlername = $data['handler'];
		$handlername = ucfirst($handlername);
		$h['handler'] = $handlername;
		
		
        $handlerManager = new Mediasharex_Manager_MediaHandler(null,$h);
		
        if ($handlerManager->exist()) {
        $handlerManager->loadfile();
        $handler = $handlerManager->loadHandler();
		$handler_html = $handler->getDisplay($data, $preview ,$width ,$height ,$richMedia,$url ,array('title' => $title, 'onclick' => $onclick, 'onmousedown' => $onmousedown, 'class' => $class, 'style' => $style));	
		}

		$folder_height = $height + 100;
		$folder_width = $height + 100;

        if (!$handler_html) {
		$handler_html = '
		<a href="'.$url.'" class="tip" "'.$data['title'].'">
		<div style="width:100%;height:'.$folder_height.'px;"></div>		
		</a>
		'; 			
		}		
		$out  = '
		<div class="mediasharex_display_album">
		<div class="mediasharex-icon-folder-close " style="font-size:'.$folder_height.'px;"></div> 				
		<div class="mediasharex_display_album_thumbnail"  style="width:'.$folder_width.'px;height:'.$height.'px;">
		'.$handler_html.'		
		</div>
		</div>';
		
		return $out;

}

