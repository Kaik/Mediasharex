<?php
/**
 * Mediasharex
 */
class Mediasharex_Block_MediasharexList extends Zikula_Controller_AbstractBlock
{
    /**
     * Initialise block.
     */
    public function init()
    {
        SecurityUtil::registerPermissionSchema('Mediasharex:block:list', 'Block Id:Pubtype Id:');
    }
	
	 /**
     * Get information on block.
     */
    public function info()
    {
        return array (
            'module'         => 'Mediasharex',
            'text_type'      => $this->__('Mediasharex List'),
            'text_type_long' => $this->__('List of mediasharex'),
            'allow_multiple' => true,
            'form_content'   => false,
            'form_refresh'   => false,
            'show_preview'   => true
        );
    }
	
	 /**
     * Display the block according its configuration.
     */
    public function display($blockinfo)
    {    // Security check
     if (!SecurityUtil::checkPermission('Mediasharex:LastSeenblock:', "$blockinfo[title]::", ACCESS_READ)) {		return false;		}
        // Get variables from content block
        $vars = BlockUtil::varsFromContent($blockinfo['content']);
        $this->view->setCaching(false);

        $params = array(
        	'items'   => 5    
			);
			
		$items = ModUtil::apiFunc('Mediasharex', 'user', 'getall', $params);
      
        $this->view->assign(ModUtil::apiFunc('Mediasharex', 'user', 'getCats'));
        $this->view->assign('items', $items);
        $blockinfo['content'] = $this->view->fetch('user/block_list.tpl');        
        return BlockUtil::themeBlock($blockinfo);


    }

    /**
     * Modify block settings.
     */
    public function modify($blockinfo)
    {
        // get current content
        $vars = BlockUtil::varsFromContent($blockinfo['content']);

        // defaults
        if (!isset($vars['tid'])) {
            $vars['tid'] = 0;
        }
        if (!isset($vars['listCount'])) {
            $vars['listCount'] = 5;
        }
        if (!isset($vars['listOffset'])) {
            $vars['listOffset'] = 0;
        }
        if (!isset($vars['cachelifetime'])) {
            $vars['cachelifetime'] = 0;
        }
        if (!isset($vars['listfilter'])) {
            $vars['listfilter'] = '';
        }
        if (!isset($vars['orderBy'])) {
            $vars['orderBy'] = '';
        }
        if (!isset($vars['template'])) {
            $vars['template'] = '';
        }

        // builds and return the output
        return $this->view->assign('vars', $vars)
                          ->assign('pubtypes', $pubtypes)
                          ->assign('pubfields', $pubfields)
                          ->fetch('clip_block_list_modify.tpl');
    }

    /**
     * Update block settings.
     */
    public function update($blockinfo)
    {
        $vars = array (
            'tid'           => FormUtil::getPassedValue('tid'),
            'orderBy'       => FormUtil::getPassedValue('orderBy'),
            'listfilter'    => FormUtil::getPassedValue('listfilter'),
            'listCount'     => FormUtil::getPassedValue('listCount'),
            'listOffset'    => FormUtil::getPassedValue('listOffset'),
            'template'      => FormUtil::getPassedValue('template'),
            'cachelifetime' => FormUtil::getPassedValue('cachelifetime')
        );

        $blockinfo['content'] = BlockUtil::varsToContent($vars);

        return $blockinfo;
    }
}
