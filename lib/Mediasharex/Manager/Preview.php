<?php
/**
 * Mediasharex
 */
class Mediasharex_Manager_Preview
{

    private $_preview;
		
	
    /**
     * construct
     */
    public function __construct($name = null, $preview = null)
    {

        $this->_preview = new Mediasharex_Base_Preview();
		
        if (isset($preview)) {
            $this->_preview->set($preview);
        } elseif ($name !== '') {
            $this->_preview->set($this->_getFromDB($name));
        } 

    }

    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function getItemArray()
    {
        if (!$this->_preview) {
            return false;
        }
        return $this->_preview->toArray();
    }
		

    /**
     * return page as array
     *
     * @return array|boolean false
     */
    public function getItem()
    {
        if (!$this->_preview) {
            return false;
        }

        return $this->_preview;
    }
	
	private function _getFromDB($id)
	{
        if (!isset($name) || empty($name)) {
            return LogUtil::registerArgsError();
        }

        // init empty comment
        $item = array();

		return $item;
	}

	public function save()
	{
		
	   $preview = $this->_preview->toArray();
	   
	   if($preview['name'] !== ''){
       return true;		   	
	   }else{
       return false;		   	
	   }	
	}	

}
