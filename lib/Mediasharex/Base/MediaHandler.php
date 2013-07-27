<?php
/**
 * Mediasharex
 */
class Mediasharex_Base_MediaHandler
{

	//table fields
    private $id;
    private $title = '';		
    private $mimetype = '';	
    private $filetype = '';
    private $foundmimetype = '';	
    private $foundfiletype = '';
    private $handler = '';
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
 	public function getMimetype()
 	{
	return $this->mimetype; 	
 	}
 	public function setMimetype($mimetype)
 	{
 	$this->mimetype = $mimetype; 	
 	}	
 	public function getFiletype()
 	{
	return $this->filetype; 	
 	}
 	public function setFileType($filetype)
 	{
 	$this->filetype = $filetype; 	
 	}	
 	public function getFoundmimetype()
 	{
	return $this->foundmimetype; 	
 	}
 	public function setFoundmimeType($foundmimetype)
 	{
 	$this->foundmimetype = $foundmimetype; 	
 	}	
 	public function getFoundfiletype()
 	{
	return $this->foundfiletype; 	
 	}
 	public function setFoundfiletype($foundfiletype)
 	{
 	$this->foundfiletype = $foundfiletype; 	
 	}		
 	public function getHandler()
 	{
	return $this->handler; 	
 	}
 	public function setHandler($handler)
 	{
 	$this->handler = $handler; 	
 	}
 	public function getActive()
 	{
	return $this->active; 	
 	}
 	public function setActive($active)
 	{
 	$this->active = $active; 	
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
	$this->setFiletype($item['filetype']);
	$this->setMimetype($item['mimetype']);
	$this->setFoundmimetype($item['foundmimetype']);	
	$this->setFoundfiletype($item['foundfiletype']);	
	$this->setHandler($item['handler']);
	$this->setActive($item['active']);

	/**/

    }

}