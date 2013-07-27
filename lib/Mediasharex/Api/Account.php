<?php
/**
 * Mediasharex
 * 
 */



class Mediasharex_Api_Account extends Zikula_AbstractApi
{

    /**
     * Return an array of items to show in the "user account page".
     */
    public function getall($args)
    {

        $items = array();


        if (SecurityUtil::checkPermission('Mediasharex:Manager:', '::', ACCESS_COMMENT)) {
                $items['0'] = array('url'     => ModUtil::url('Mediasharex', 'user', 'manager'),
                        'module'  => 'Mediasharex',
                        'title'   => $this->__('Mediasharex manager'),
                        'icon'    => 'manager.png');
        }
        

        // Return the items
        return $items;
    }
}