<?php
/**
 * Mediasharex
 */
class Mediasharex_Base_Album
{

	//table fields
    private $id;
    private $title = '';	
    private $description = '';
    private $summary = '';		
    private $parentalbum;
	private $mainmedia;
    private $template = '';
	private $accesslevel = '';
	private $viewkey = '';
	private $hitcount = 0;	
    private $author;
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
 	public function getSummary()
 	{
	return $this->summary; 	
 	}
 	public function setSummary($summary)
 	{
 	$this->summary = $summary; 	
 	}	
 	public function getParentalbum()
 	{
	return $this->parentalbum; 	
 	}
 	public function setParentalbum($parentalbum)
 	{
 	$this->parentalbum = $parentalbum; 	
 	}
 	public function getMainmedia()
 	{
	return $this->mainmedia; 	
 	}
 	public function setMainmedia($mainmedia)
 	{
 	$this->mainmedia = $mainmedia; 	
 	}
 	public function getTemplate()
 	{
	return $this->template; 	
 	}
 	public function setTemplate($template)
 	{
 	$this->template = $template; 	
 	}
 	public function getAccesslevel()
 	{
	return $this->accesslevel; 	
 	}
 	public function setAccesslevel($accesslevel)
 	{
 	$this->accesslevel = $accesslevel; 	
 	}
 	public function getViewkey()
 	{
	return $this->viewkey; 	
 	}
 	public function setViewkey($viewkey)
 	{
 	$this->viewkey = $viewkey; 	
 	}
 	public function getHitcount()
 	{
	return $this->hitcount; 	
 	}
 	public function setHitcount($hitcount)
 	{
 	$this->hitcount = $hitcount; 	
 	}
 	public function getAuthor()
 	{
	return $this->author; 	
 	}
 	public function setAuthor($author)
 	{
 	$this->author = $author; 	
 	}
 	public function getReferenceid()
 	{
	return $this->referenceid; 	
 	}
 	public function setReferenceid($referenceid)
 	{
 	$this->referenceid = $referenceid; 	
 	}

    private $nestedsetlevel;	
    private $nestedsetleft;	
    private $nestedsetright;	
	
 	public function getNestedsetlevel()
 	{
	return $this->nestedsetlevel; 	
 	}
 	public function setNestedsetlevel($nestedsetlevel)
 	{
 	$this->nestedsetlevel = $nestedsetlevel; 	
 	}	
 	public function getNestedsetleft()
 	{
	return $this->nestedsetleft; 	
 	}
 	public function setNestedsetleft($nestedsetleft)
 	{
 	$this->nestedsetleft = $nestedsetleft; 	
 	}	
 	public function getNestedsetright()
 	{
	return $this->nestedsetright; 	
 	}
 	public function setNestedsetright($nestedsetright)
 	{
 	$this->nestedsetright = $nestedsetright; 	
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
		
    private $thumbnailsize;

 	public function getThumbnailsize()
 	{
	return $this->thumbnailsize; 	
 	}
 	public function setThumbnailsize($thumbnailsize)
 	{
 	$this->thumbnailsize = $thumbnailsize; 	
 	}

	private $extappurl;
	private $extappdata;

 	public function getExtappurl()
 	{
	return $this->extappurl; 	
 	}
 	public function setExtappurl($extappurl)
 	{
 	$this->extappurl = $extappurl; 	
 	}
 	public function getExtappdata()
 	{
	return $this->extappdata; 	
 	}
 	public function setExtappdata($extappdata)
 	{
 	$this->extappdata = $extappdata; 	
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
	
	$this->setId($item['id']);
	$this->setTitle($item['title']);
	$this->setDescription($item['description']);
	$this->setSummary($item['summary']);	
	$this->setParentalbum($item['parentalbum']);
	$this->setMainmedia($item['mainmedia']);
	$this->setTemplate($item['template']);
	$this->setAccesslevel($item['accesslevel']);
	$this->setViewkey($item['viewkey']);
  	$this->setHitcount($item['hitcount']);
	$this->setNestedsetlevel($item['nestedsetlevel']);
	$this->setNestedsetleft($item['nestedsetleft']);
	$this->setNestedsetright($item['nestedsetright']);
	$this->setAuthor($item['author']);					
	$this->setThumbnailsize($item['thumbnailsize']);	
	$this->setExtappurl($item['extappurl']);
	$this->setExtappdata($item['extappdata']);
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