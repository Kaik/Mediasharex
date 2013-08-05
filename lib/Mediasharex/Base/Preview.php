<?php
/**
 * Mediasharex
 */
class Mediasharex_Base_Preview
{

	//table fields
    private $name;
    private $width = '';	
    private $height = '';
    private $class = '';		
    private $richmedia;	
    private $default;

	
 	public function getName()
 	{
 	return $this->name;
 	}
 	public function setName($name)
 	{
 	$this->name = $name;
 	}
 	public function getWidth()
 	{
	return $this->width; 	
 	}
 	public function setWidth($width)
 	{
 	$this->width = $width; 	
 	}	
 	public function getClass()
 	{
	return $this->class; 	
 	}
 	public function setClass($class)
 	{
 	$this->class = $class; 	
 	}
 	public function isRichmedia()
 	{
	return $this->richmedia; 	
 	}
 	public function setRichmedia($richmedia)
 	{
 	$this->richmedia = $richmedia; 	
 	}
 	public function isDefault()
 	{
	return $this->default; 	
 	}
 	public function setDefault($default)
 	{
 	$this->default = $default; 	
 	}
	
		
	 /**
     * return as array
     *
     * @return array|boolean false
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
	/**
     * set 
     */
    public function set($item)
    {
	
	$this->setName($item['name']);
	$this->setWidth($item['width']);
	$this->setHeight($item['height']);
	$this->setClass($item['class']);	
	$this->setRichmedia($item['richmedia']);
	$this->setDefault($item['default']);
	
	/**/

    }

}