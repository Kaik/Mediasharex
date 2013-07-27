<?php
/**
 * Mediasharex
 */
class Mediasharex_Base_MediaItem
{

	//table fields
    private $id;
    private $title = '';	
    private $description = '';	
    private $parentalbum;
    private $position;
    private $handler = '';
    private $author;	
	private $hitcount = 0;	
    private $original = 0;	
	private $referenceid = '';	
	
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
 	public function getDescription()
 	{
	return $this->description; 	
 	}
 	public function setDescription($description)
 	{
 	$this->description = $description; 	
 	}
 	public function getParentalbum()
 	{
	return $this->parentalbum; 	
 	}
 	public function setParentalbum($parentalbum)
 	{
 	$this->parentalbum = $parentalbum; 	
 	}
 	public function getPosition()
 	{
	return $this->position; 	
 	}
 	public function setPosition($position)
 	{
 	$this->position = $position; 	
 	}
 	public function getHandler()
 	{
	return $this->handler; 	
 	}
 	public function setHandler($handler)
 	{
 	$this->handler = $handler; 	
 	}
 	public function getAuthor()
 	{
	return $this->author; 	
 	}
 	public function setAuthor($author)
 	{
 	$this->author = $author; 	
 	}
 	public function getHitcount()
 	{
	return $this->hitcount; 	
 	}
 	public function setHitcount($hitcount)
 	{
 	$this->hitcount = $hitcount; 	
 	}
 	public function getOriginal()
 	{
	return $this->original; 	
 	}
 	public function setOriginal($original)
 	{
 	$this->original = $original; 	
 	}	
 	public function getReferenceid()
 	{
	return $this->referenceid; 	
 	}
 	public function setReferenceid($referenceid)
 	{
 	$this->referenceid = $referenceid; 	
 	}
	//zk standard fields
   	private $obj_status = 'A';
   	private $cr_uid;
   	private $cr_date;
    private $lu_uid;
    private $lu_date;
	private $__CATEGORIES__;
	private $__ATTRIBUTIES__;
	
 	public function getObj_status()
 	{
	return $this->obj_status; 	
 	}
 	public function setObj_status($obj_status)
 	{
 	$this->obj_status = $obj_status; 	
 	}		
 	public function getCr_uid()
 	{
	return $this->cr_uid; 	
 	}
 	public function setCr_uid($cr_uid)
 	{
 	$this->cr_uid = $cr_uid; 	
 	}
 	public function getCr_date()
 	{
	return $this->cr_date; 	
 	}
 	public function setCr_date($cr_date)
 	{
 	$this->cr_date = $cr_date; 	
 	}	
 	public function getLu_uid()
 	{
	return $this->lu_uid; 	
 	}
 	public function setLu_uid($lu_uid)
 	{
 	$this->lu_uid = $lu_uid; 	
 	}		
	public function getLu_date()
 	{
	return $this->lu_date; 	
 	}
 	public function setLu_date($lu_date)
 	{
 	$this->lu_date = $lu_date; 	
 	}
 	public function getCategories()
 	{
	return $this->__CATEGORIES__; 	
 	}
 	public function setCategories($__CATEGORIES__)
 	{
 	$this->__CATEGORIES__ = $__CATEGORIES__; 	
 	}	
	public function getAttributies()
 	{
	return $this->__ATTRIBUTIES__; 	
 	}
 	public function setAttributies($__ATTRIBUTIES__)
 	{
 	$this->__ATTRIBUTIES__ = $__ATTRIBUTIES__; 	
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
	$this->setDescription($item['description']);	
	$this->setParentalbum($item['parentalbum']);
	$this->setPosition($item['position']);
	$this->setHandler($item['handler']);
	$this->setAuthor($item['author']);
  	$this->setHitcount($item['hitcount']);	
	$this->setOriginal($item['original']);
	$this->setReferenceid($item['referenceid']);		
	$this->setObj_status($item['obj_status']);
	$this->setCr_uid($item['cr_uid']);						
	$this->setCr_date($item['cr_date']);
	$this->setLu_uid($item['lu_uid']);	
	$this->setLu_date($item['lu_date']);		
	$this->setCategories($item['__CATEGORIES__']);	
	$this->setAttributies($item['__ATTRIBUTIES__']);	
	
	/**/

    }

}