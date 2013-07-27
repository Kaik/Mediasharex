<?php
/**
 * Mediasharex
 */
class Mediasharex_Installer extends Zikula_AbstractInstaller
{
    /**
      */
    protected function getDefaultModVars()
    {
        return array();
    }

    /**
     */
    public function install()
    {
        
        return true;
    }
    /**
     */
    public function upgrade($oldversion)
    {

        // Update successful
        return true;
    }

    /**
     */
    public function uninstall()
    {
       
        // Deletion successful
        return true;
    }


    /**
     * create the default category tree
     */
    private function _createdefaultcategory($regpath = '/__SYSTEM__/Modules/Global')
    {
        // get the language file
        $lang = ZLanguage::getLanguageCode();

        // get the category path for which we're going to insert our place holder category
    
        $c = CategoryUtil::getCategoryByPath($regpath.'/MContent');
        if (!$c) {
            $c = CategoryUtil::getCategoryByPath($regpath);

            $args = array(
                'cid'   => $c['id'],
                'name'  => 'MCo',
                'dname' => array($lang => $this->__('Clip')),
                'ddesc' => array($lang => $this->__('Clip root category'))
            );
            if (!$this->createCategory($args)) {
                return false;
            }
        }
        return true;
    }
    
        
}