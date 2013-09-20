<?php

class Mediasharex_MediaStorage_Db {
        

    public function createFile($filename, $args)
    {
        $dom = ZLanguage::getModuleDomain('mediashare');

        $fileReference = "vfsdb/$args[baseFileRef]-$args[fileMode].$args[fileType]";

        $data  = file_get_contents($filename);
        $bytes = count($data);

        $record = array(
            'fileref' => $fileReference,
            'mode'    => $args['fileMode'],
            'type'    => $args['fileType'],
            'bytes'   => $bytes,
            'data'    => $data
        );

        $result = DBUtil::insertObject($record, 'mediashare_mediadb', 'id');

        if ($result === false) {
            return LogUtil::registerError(__f('Error in %1$s: %2$s.', array('vfsHandlerDB.createFile', 'Could not retrieve insert the file information.'), $dom));
        }

        return $fileReference;
    }

    public function deleteFile($fileReference)
    {
        $dom = ZLanguage::getModuleDomain('mediashare');

        $pntable       = pnDBGetTables();
        $mediadbColumn = $pntable['mediashare_mediadb_column'];

        $fileReference = DataUtil::formatForStore($fileReference);
        $where         = "$mediadbColumn[fileref] = '$fileReference'";
        
        $result = DBUtil::deleteWhere('mediashare_mediadb', $where);

        if ($result === false) {
            return LogUtil::registerError(__f('Error in %1$s: %2$s.', array('vfsHandlerDB.deleteFile', 'Could not delete the file information.'), $dom));
        }

        return true;
    }

    public function updateFile($orgFileReference, $newFilename)
    {
        $dom = ZLanguage::getModuleDomain('mediashare');

        $pntable = pnDBGetTables();

        $mediadbTable  = $pntable['mediashare_mediadb'];
        $mediadbColumn = $pntable['mediashare_mediadb_column'];

        $data  = file_get_contents($newFilename);
        $bytes = count($data);
        $orgFileReference = DataUtil::formatForStore($orgFileReference);

        $sql = "UPDATE $mediadbTable
                   SET $mediadbColumn[data] = '" . DataUtil::formatForStore($data) . "',
                       $mediadbColumn[bytes] = '$bytes'
                 WHERE $mediadbColumn[fileref] = '$orgFileReference'";

        $result = DBUtil::executeSQL($sql);

        if ($result === false) {
            return LogUtil::registerError(__f('Error in %1$s: %2$s.', array('vfsHandlerDB.updateFile', 'Could not update the file information.'), $dom));
        }

        return true;
    }

    public function getNewFileReference()
    {
        $chars = "0123456789abcdefghijklmnopqrstuvwxyz";
        $charLen = strlen($chars);

        $id = '';

        for ($i = 0; $i < 30; ++$i) {
            $id .= $chars[mt_rand(0, $charLen - 1)];
        }

        return $id;
    }
	
	     
}