<?php
/**
 * Mediasharex
 */

/**
 * Administrative API functions.
 */
class Mediasharex_Api_Admin extends Zikula_AbstractApi
{
	
	
	
    public function mediashareDirIsWritable($dir)
	{
    return is_dir($dir) && is_writable($dir);
	}	

    /**
     * Get available admin panel links.
     *
     * @return array Array of adminpanel links.
     */
    public function getLinks()
    {
        $links = array();
		
		$modulevars = ModUtil::getVar('Mediasharex');

		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'info'), 'text' => $this->__('Info'), 'class' => 'z-icon-es-help');
        }
		
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'mainsettings'), 'text' => $this->__('Main settings'), 'class' => 'z-icon-es-config');
        }

        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'managealbums'), 'text' => $this->__('Albums'), 'class' => 'z-icon-es-display');
        }
		
        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'manageitems'), 'text' => $this->__('Media'), 'class' => 'z-icon-es-display');
        }
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'managemediastore'), 'text' => $this->__('Media store'), 'class' => 'z-icon-es-display');
        }
		
        if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'managehandlers'), 'text' => $this->__('Handlers'), 'class' => 'z-icon-es-display');
        }
				
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'managesources'), 'text' => $this->__('Sources'), 'class' => 'z-icon-es-display');
        }
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'manageinvitations'), 'text' => $this->__('Invitations'), 'class' => 'z-icon-es-display');
        }
		if (SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
            $links[] = array('url' => ModUtil::url($this->name, 'admin', 'import'), 'text' => $this->__('Import'), 'class' => 'z-icon-es-filter');
        }		
        return $links;
    }
}