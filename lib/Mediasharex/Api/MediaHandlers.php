<?php
/**
 * Mediasharex
 */
class Mediasharex_Api_MediaHandlers extends Zikula_AbstractApi
{



	public function getFromDir()
    {

	$dir = 'MediaHandlers';


     // Check access
    if (!SecurityUtil::checkPermission('Mediasharex::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError();
    }

    $dom = ZLanguage::getModuleDomain('mediashare');
    
    // Clear existing handler table
   // if (!DBUtil::truncateTable('mediashare_mediahandlers')) {
    //    return LogUtil::registerError(__f('Error in %1$s: %2$s.', array('mediahandlerapi.scanMediaHandlers', __f("Could not clear the '%s' table.", 'mediahandlers', $dom)), $dom));
   // }

    // Scan for handlers APIs
    $files = FileUtil::getFiles('modules/Mediasharex/lib/Mediasharex/MediaHandlers', false, true, 'php', 'f');
    foreach ($files as $file)
    {
        if (preg_match('/^Media_([-a-zA-Z0-9_]+).php$/', $file, $matches)) {
            $handlerName = $matches[1];
            $handlerApi  = "media_$handlerName";

            // Force load - it is used during pninit
            pnModAPILoad('mediashare', $handlerApi, true);

            if (!($handler = pnModAPIFunc('mediashare', $handlerApi, 'buildHandler'))) {
                return false;
            }

            $fileTypes = $handler->getMediaTypes();
            foreach ($fileTypes as $fileType)
            {
                $fileType['handler'] = $handlerName;
                $fileType['title']   = $handler->getTitle();

                if (!pnModAPIFunc('mediashare', 'mediahandler', 'addMediaHandler', $fileType)) {
                    return false;
                }
            }
        }
    }

    return true;
}
	

}



