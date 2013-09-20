<?php
/**
 */
function smarty_function_breadcrumbs($params, $view)
{

		$path       	= isset($params['path']) ? $params['path'] : false;
    	$crumbsId 	 	= isset($params['crumbsId']) ? $params['crumbsId'] : false;
    	$crumbsClass 	= isset($params['crumbsClass']) ? $params['crumbsClass'] : false;
    	
    	
		$out = _getHtml($path,$crumbsId,$crumbsClass);
		
		return $out;

}



function _getHtml($path,$crumbsId,$crumbsClass)
  {
        $html = '<ul';
       	$html .= !empty($crumbsId) ? ' id="'.$crumbsId.'"' : '';
        $html .= !empty($crumbsClass) ? ' class="'.$crumbsClass.'"' : '';
        $html .= '>';
    
       foreach ($path as $node) {
            $html .= '<li';
            $html .= !empty($treeNodePrefix) ? ' id="'.$treeNodePrefix.$tab['item']['id'].'"' : '';
            $html .= !empty($treeClassPrefix) ? ' class="'.$treeClassPrefix.$tab['item']['id'].'"' : '';
            $html .= '>';
            $attr  = !empty($tab['item']['title']) ? ' title="'.$tab['item']['title'].'"' : '';
            $attr .= !empty($tab['item']['class']) ? ' class="'.$tab['item']['class'].'"' : '';
            if(!empty($tab['item']['href'])) {
                $html .= '<a href="'.DataUtil::formatForDisplay($tab['item']['href']).'"'.$attr.'>'.$tab['item']['name'].'</a>';
            } else {
               $html .= '<span'.$attr.'><i class="mediasharex-icon-folder"> </i>  '.$node['title'].'</span>';
           }
           $html .= !empty($tab['children']) ? _htmlList($tab['children'],$treeNodePrefix,$treeClassPrefix) : '';
           $html .= '</li>';
       }
   
       $html .= '</ul>';
   
       return $html;
  }






