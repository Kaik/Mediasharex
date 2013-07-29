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

        if (!$handler_html) {
		$handler_html = '<a href="'.$url.'" class="tip" "'.$data['title'].'"><i class="icon-picture" style="font-size:'.$height.'px;"></i> </a>'; 	
		
		}
		
		$out  = '<div class="mediasharex_display_subalbum_icon"  style="width:'.$width.'px;height:'.$height.'px;">'.$handler_html.'</div>';
		
		return $out;

}

