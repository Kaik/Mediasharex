<?php

class Mediasharex_MediaStorage_Dir {
	 	        

    private $storageDir;

    public function __construct($mode = null)
    {	
		if($mode){			
        $this->storageDir = ModUtil::getVar('Mediasharex','mediaTmpName');
		}else{
		$this->storageDir = ModUtil::getVar('Mediasharex','mediaDirName');	
		}    
    }

    public function createFile($filename, $args)
    {

        $fileReference = "$args[baseFileRef]-$args[fileMode].$args[fileType]";
        $newFilename   = $this->storageDir . '/' . DataUtil::formatForOS($fileReference);

        if (!@copy($filename, $newFilename)) {
            return LogUtil::registerError(__f('Unable to copy the file from \'%1$s\' to \'%2$s\'', array($filename, $newFilename), $dom).' '.__("while creating new file in virtual storage system. Please check media upload directory in admin settings and it's permissions.", $dom));
        }

        chmod($newFilename, 0777);
        return $fileReference;
    }

    public function deleteFile($fileReference)
    {
        $filename = $this->storageDir . '/' . DataUtil::formatForOS($fileReference);
        unlink($filename);
    }

    public function updateFile($orgFileReference, $newFilename)
    {
        //$dom = ZLanguage::getModuleDomain('mediashare');

        $orgFilename = $this->storageDir . '/' . DataUtil::formatForOS($orgFileReference);

        if (!copy($newFilename, $orgFilename)) {
            return LogUtil::registerError(__f('Unable to copy the file from \'%1$s\' to \'%2$s\'', array($newFilename, $orgFileReference), $dom));
        }

        return true;
    }

    public function getNewFileReference()
    {
        $chars = "0123456789abcdefghijklmnopqrstuvwxyz";
        $charLen = strlen($chars);

        $id = $chars[mt_rand(0, $charLen-1)] . $chars[mt_rand(0, $charLen-1)];

        $mediadir = $this->storageDir;
        if (!file_exists($mediadir.'/'.$id)) {
            FileUtil::mkdirs($mediadir.'/'.$id, 0777);
        }

        $id .= '/';

        for ($i=0; $i<30; ++$i) {
            $id .= $chars[mt_rand(0, $charLen-1)];
        }

        return $id;
    }
 
}