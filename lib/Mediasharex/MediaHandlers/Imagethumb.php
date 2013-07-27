<?php
/**
 * Mediasharex
 */
class Mediasharex_MediaHandlers_Imagethumb
{

    public function getTitle()
    {       
    return 'Mediashare Image Thumb Handler';//$this->__('Mediashare Youtube Handler');
    }	
 	public function getMimetype()
 	{
	return array(
            array('mimetype' => 'image/pjpeg',
                  'filetype' => 'jpg',
                  'foundmimetype' => 'image/jpeg',
                  'foundfiletype' => 'jpg'),
            array('mimetype' => 'image/jpeg',
                  'filetype' => 'jpeg',
                  'foundmimetype' => 'image/jpeg',
                  'foundfiletype' => 'jpg'),
            array('mimetype' => 'image/png',
                  'filetype' => 'png',
                  'foundmimetype' => 'image/png',
                  'foundfiletype' => 'png'),
            array('mimetype' => 'image/gif',
                  'filetype' => 'gif',
                  'foundmimetype' => 'image/gif',
                  'foundfiletype' => 'gif')); 	
 	}	
 	public function getFiletype()
 	{
	return 'you'; 	
 	}
 	public function getFoundmimetype()
 	{
	return 'video/youtube'; 	
 	}
 	public function getFoundfiletype()
 	{
	return 'you'; 	
 	}	
	
	
    public function Display($args, $previews)
    {
    	/*
        $mediaFilename = $args['mediaFilename'];
        $mimeType = $args['mimeType'];
        $mediaFileType = $args['fileType'];

				$v = getyoutubevideocode($mediaFilename);
				$url   = mediasharemediaYoutubeXmlInfo($v);

				// Create tmp. file and copy image data into it
				$tmpdir = pnModGetVar('mediashare', 'tmpDirName');
				$tmpfilename = tempnam($tmpdir, 'xxx');

				if (!($in = fopen($url['thumbnail'], "rb"))) {

				}

				$out=   fopen($tmpfilename, "wb");

				while ($chunk = fread($in,8192))
				{
        fwrite($out, $chunk, 8192);
				}

				fclose($in);
				fclose($out);


        $result = array();

        foreach ($previews as $preview)
        {
            if ($preview['isThumbnail']) {
                copy($tmpfilename, $preview['outputFilename']);
                $imPreview = @imagecreatefromjpeg($preview['outputFilename']);
                $result[] = array('fileType' => 'png',
                                  'mimeType' => 'image/png',
                                  'width'    => imagesx($imPreview),
                                  'height'   => imagesy($imPreview),
                                  'bytes'    => filesize($preview['outputFilename']));
                imagedestroy($imPreview);
            } else {
                $width = $preview['imageSize'];
                $height = $preview['imageSize'];
                if (isset($args['width']) && (int)$args['width'] > 0 && isset($args['height']) && (int)$args['height'] > 0) {
                    $w = (int)$args['width'];
                    $h = (int)$args['height'];

                    if ($w < $width || $h < $height) {
                        $width = $w;
                        $height = $h;
                    } else if ($w > $h) {
                        $height = ($h / $w) * $height;
                    } else {
                        $width = ($w / $h) * $width;
                    }
                }

                $result[] = array('fileType' => $mediaFileType,
                                  'mimeType' => $mimeType,
                                  'width'    => $width,
                                  'height'   => $height,
                                  'useOriginal' => true,
                                  'bytes' => filesize($preview['outputFilename']));
            }
        }

				unlink($tmpFilename);

        $width  = (isset($args['width']) && (int)$args['width'] > 0   ? (int)$args['width']  : $preview['imageSize']);
        $height = (isset($args['height']) && (int)$args['height'] > 0 ? (int)$args['height'] : $preview['imageSize']);

        $result[] = array('fileType' => $mediaFileType,
                          'mimeType' => $mimeType,
                          'width'    => $width,
                          'height'   => $height,
                          'bytes'    => filesize($mediaFilename));

        return $result;
    }

    public function getMediaDisplayHtml($url, $width, $height, $id, $args)
    {
        $dom = ZLanguage::getModuleDomain('mediashare');

        //$width="100px"; $height="100px";
        $widthHtml  = ($width == null  ? '' : " width=\"$width\"");
        $heightHtml = ($height == null ? '' : " height=\"$height\"");


				$theData = getyoutubevideocode($url);		

				$output='<object width="425" height="350">
					 <param name="movie" value="http://www.youtube.com/v/'.$theData.'" />
					 <param name="wmode" value="transparent" />
					 <embed src="http://www.youtube.com/v/'.$theData.'"
           type="application/x-shockwave-flash"
           wmode="transparent" width="425" height="350" />
           </object>';

       */
        return $output;
    }


    public function mediasharemediaYoutubeXmlInfo($v)
    {

	$xml = 'http://gdata.youtube.com/feeds/api/videos/'.$v.'';
	$content = simplexml_load_file($xml);	

	$video['title'] = (string)$content->title;
	$video['description'] = (string)$content->content;

	$media = $content->children('http://search.yahoo.com/mrss/');
	$attr1 = $media->group->thumbnail[0]->attributes();
	$video['thumbnail']  = (string)$attr1['url']; // thumbnail url

	$yt   = $media->children('http://gdata.youtube.com/schemas/2007');
	$attr2 = $yt->duration->attributes();
	$length  = $attr2['seconds']; // in seconds
	$video_duration = round($length/60,2); // in minutes

	return $video;
	}



	public	function getyoutubevideocode($url)
	{
	$fh = fopen($url, 'r');
	$theData = fread($fh, filesize($url));
				fclose($fh);		
	return $theData;
	}


		
}
