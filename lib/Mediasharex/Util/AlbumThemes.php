<?php

class Mediasharex_Util_AlbumThemes {
        

   public function getThemes() 
	{								
		$themesPath = 'modules/Mediasharex/templates/user/themes';
        $themes = FileUtil::getFiles($themesPath,  false, true, false, false);	

		return $themes;	
	}
	
   public function getThemesSelect() 
	{								
        $themes = Mediasharex_Util_AlbumThemes::getThemes();
		$themes_select = array();
		foreach ($themes as $key => $theme) {
		$themes_select[$key] = array('text' => $theme,'value'=> $theme);				
		}
		return $themes_select;	
	}	
	
	        
}