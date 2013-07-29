<?php

class Mediasharex_Util_RstFile {
        

   public function getFile($file_path) 
	{								

	$file = file_get_contents($file_path);
	return $file;	
	
	}
	
   public function saveFile($file_path,$file_content) 
	{								

	$ok = file_put_contents($file_path, $file_content);
	return $ok;	
	
	}	
	
	
   public function readFile($file_path) 
	{				
     require_once 'modules/Mediasharex/lib/vendor/php-restructuredtext/rst.php';				
	$file_to_covnert = Mediasharex_Util_RstFile::getFile($file_path);
	$file_to_display = RST($file_to_covnert);
	return $file_to_display;	
	
	}  	
	
	        
}