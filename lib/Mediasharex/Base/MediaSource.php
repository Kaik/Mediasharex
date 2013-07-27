<?php
/**
 * Mediasharex
 */
class Mediasharex_Base_MediaSource
{

	//table fields
    private $id;
    private $title = '';	
    private $name = '';	
    private $formenctype = '';
    private $active = 0;
	

 	public function getId()
 	{
 	return $this->id;
 	}
 	public function setId($id)
 	{
 	$this->id = $id;
 	}
 	public function getTitle()
 	{
	return $this->title; 	
 	}
 	public function setTitle($title)
 	{
 	$this->title = $title; 	
 	}
 	public function getName()
 	{
	return $this->name; 	
 	}
 	public function setName($name)
 	{
 	$this->name = $name; 	
 	}
 	public function getFormenctype()
 	{
	return $this->formenctype; 	
 	}
 	public function setFormenctype($formenctype)
 	{
 	$this->formenctype = $formenctype; 	
 	}
 	public function getActive()
 	{
	return $this->active; 	
 	}
 	public function setActive($active)
 	{
 	$this->active = (bool)$active; 	
 	}
	/**
     * return page as array
     *
     * @return array|boolean false
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
	/**
     * return page as array
     *
     * @return array|boolean false
     */
    public function set($item)
    {
	
	$this->setId($item['id']);
	$this->setTitle($item['title']);
	$this->setName($item['name']);	
	$this->setFormenctype($item['formenctype']);
	$this->setActive($item['active']);

	/**/

    }

}