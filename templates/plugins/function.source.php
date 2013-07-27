<?php
/**
 */
function smarty_function_source($params, $view)
{


    $data       = isset($params['data']) ? $params['data'] : false;
    $preview 	 = isset($params['preview']) ? $params['preview'] : 'add';

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
   	
    	$sourcename = $data['name'];
		$sourcename = ucfirst($sourcename);
		$s['name'] = $sourcename;	
        $sourceManager = new Mediasharex_Manager_MediaSource(null,$s);	
        if (!$sourceManager->exist()) {		
		return false;			
		}			
        $sourceManager->loadfile();
        $source = $sourceManager->loadSource();
		$output = $source->getDisplay($data, $preview ,$width ,$height ,$richMedia ,array('title' => $title, 'onclick' => $onclick, 'onmousedown' => $onmousedown, 'class' => $class, 'style' => $style));
		$template = $source->getTemplate($preview);
		$output['plugin'] = $source->getPlugin($view);
	  
        return $view->assign('sourcedata', $output)
        ->fetch($template);
		

	 //   return $result;		
		
	//	}


	

}
