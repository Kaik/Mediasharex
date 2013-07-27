<?php
/**
 */
function smarty_function_mediaitem($params, &$smarty)
{


    $data       = isset($params['data']) ? $params['data'] : false;
    $preview 	 = isset($params['preview']) ? $params['preview'] : false;
    $url 	 = isset($params['url']) ? $params['url'] : false;
	//override defaults and previews
    $width       = isset($params['width']) ? $params['width'] : null;
    $height       = isset($params['height']) ? $params['height'] : null;
	
    $richMedia       = isset($params['richMedia']) ? $params['richMedia'] : false;	
  
    $class       = isset($params['class']) ? $params['class'] : null;
    $style       = isset($params['style']) ? $params['style'] : null;
    $onclick     = isset($params['onclick']) ? $params['onclick'] : null;
    $onmousedown = isset($params['onmousedown']) ? $params['onmousedown'] : null;


    //if ($data === false) {
      //  $result = __('No media item found in this album', $dom);

   // } else if($data['handler']) {
   	
    	$handlername = $data['handler'];
		$handlername = ucfirst($handlername);
		$h['handler'] = $handlername;
		
		
        $handlerManager = new Mediasharex_Manager_MediaHandler(null,$h);
		
        if ($handlerManager->exist()) {
        $handlerManager->loadfile();
        $handler = $handlerManager->loadHandler();
		$result = $handler->getDisplay($data, $preview ,$width ,$height ,$richMedia,$url ,array('title' => $title, 'onclick' => $onclick, 'onmousedown' => $onmousedown, 'class' => $class, 'style' => $style));
		
        return $result;
		}

	 //   return $result;		
		
	//	}

	
	

}
