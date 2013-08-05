<?php
/**
 * Mediasharex
 */
class Mediasharex_Manager_Previews
{

    private $previews;
		
	
    /**
     * construct
     */
    public function __construct()
    {
		
	   $this->previews = ModUtil::getVar('Mediasharex','previews',false);     
           
    }

    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function getPreviews()
    {
        if (!$this->previews) {
            return false;
        }
        return $this->previews;
    }

    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function getDefault()
    {
        if (!$this->previews) {
            return false;
        }
		
		foreach ($this->previews as $preview_name => $preview){
		if ($preview['default']){
		$preview['name'] = $preview_name;		
        return $preview;			
		}
		}

    }	
	
    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function setPreviews($previews)
    {
        if (!$previews) {
            return false;
        }
        $this->previews = $previews;
    }	

    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function savePreviews()
    {
        if (!$this->previews) {
            return false;
        } 		
		$previews = $this->previews;
		if(ModUtil::setVar('Mediasharex','previews',$previews)){
		return true;			
		}else{
		return false;	
		}		

    }
			

}
