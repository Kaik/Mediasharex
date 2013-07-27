<?php
/**
 * Mediasharex
 */
class Mediasharex_Base_MediaStoreItem
{

	//table fields
    private $id;
    private $mediaitem = 0;
    private $previewname = '';	
    private $fileref = '';	
    private $mimetype = '';	
    private $width = '';
    private $height = '';
    private $bytes = 0;
	

 	public function getId()
 	{
 	return $this->id;
 	}
 	public function setId($id)
 	{
 	$this->id = $id;
 	}
 	public function getMediaitem()
 	{
	return $this->mediaitem; 	
 	}
 	public function setMediaitem($mediaitem)
 	{
 	$this->mediaitem = $mediaitem; 	
 	}
 	public function getPreviewname()
 	{
	return $this->previewname; 	
 	}
 	public function setPreviewname($previewname)
 	{
 	$this->previewname = $previewname; 	
 	}	
 	public function getFileref()
 	{
	return $this->fileref; 	
 	}
 	public function setFileref($fileref)
 	{
 	$this->fileref = $fileref; 	
 	}
 	public function getMimetype()
 	{
	return $this->mimetype; 	
 	}
 	public function setMimetype($mimetype)
 	{
 	$this->mimetype = $mimetype; 	
 	}
 	public function getWidth()
 	{
	return $this->width; 	
 	}
 	public function setWidth($width)
 	{
 	$this->width = $width; 	
 	}
 	public function getHeight()
 	{
	return $this->height; 	
 	}
 	public function setHeight($height)
 	{
 	$this->height = $height; 	
 	}
 	public function getBytes()
 	{
	return $this->bytes; 	
 	}
 	public function setBytes($bytes)
 	{
 	$this->bytes = $bytes; 	
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
	$this->setMediaitem($item['mediaitem']);
	$this->setPreviewname($item['previewname']);	
	$this->setFileref($item['fileref']);
	$this->setMimetype($item['mimetype']);	
	$this->setWidth($item['width']);
	$this->setHeight($item['height']);
	$this->setBytes($item['bytes']);
	/**/

    }

}