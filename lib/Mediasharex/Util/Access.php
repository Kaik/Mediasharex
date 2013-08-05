<?php

class Mediasharex_Util_Access {
        

   public function getAccess() 
	{								

	$access = array('Public' => 0,
	 				'Private' => 1,
					'Only me' => 2
	);	
	
	
	return $access;
	}

   public function getAccessSelect() 
	{								
        $access = Mediasharex_Util_Access::getAccess();
		$access_select = array();
		foreach ($access as $name => $value) {
		$access_select[] = array('text' => $name,'value'=> $value);				
		}
		return $access_select;	
	}	
	     
}