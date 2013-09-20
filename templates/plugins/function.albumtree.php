<?php
/**
 */
function smarty_function_albumtree($params, $view)
{

		$tree       = isset($params['tree']) ? $params['tree'] : false;
    	$treeId 	= isset($params['treeId']) ? $params['treeId'] : false;
    	$treeClass 	= isset($params['treeClass']) ? $params['treeClass'] : false;

		$out = _htmlList($tree,$treeNodePrefix,$treeClassPrefix,$treeId,$treeClass);
		
		return $out;

}



function _htmlList($tree,$treeNodePrefix,$treeClassPrefix,$treeId = '',$treeClass = '')
  {
        $html = '<ul';
       	$html .= !empty($treeId) ? ' id="'.$treeId.'"' : '';
        $html .= !empty($treeClass) ? ' class="'.$treeClass.'"' : '';
        $html .= '>';
    
       foreach ($tree as $tab) {
            $html .= '<li';
            $html .= !empty($treeNodePrefix) ? ' id="'.$treeNodePrefix.$tab['id'].'"' : '';
            $html .= !empty($treeClassPrefix) ? ' class="'.$treeClassPrefix.$tab['id'].'"' : '';
            $html .= '>';
            $attr  = !empty($tab['title']) ? ' title="'.$tab['title'].'"' : '';
            $attr .= !empty($tab['class']) ? ' class="'.$tab['class'].'"' : '';
			$tab['href'] = ModUtil::url('Mediasharex','admin','manager_albums',array('album' => $tab['id']));
			$icon = !empty($tab['children']) ? '<i class="mediasharex-icon-folder-open"> </i>': '<i class="mediasharex-icon-folder"> </i>';
			
           	$html .= '<a href="'.DataUtil::formatForDisplay($tab['href']).'"'.$attr.'><span'.$attr.'>'.$icon.''.$tab['title'].'</span></a>';
  
			
			
           $html .= !empty($tab['children']) ? _htmlList($tab['children'],$treeNodePrefix,$treeClassPrefix) : '';
           $html .= '</li>';
       }
   
       $html .= '</ul>';
   
       return $html;
  }






