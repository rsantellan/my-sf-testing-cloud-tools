<?php

/**
 * Description of myCliImagickConvertor
 *
 * @author Rodrigo Santellan
 */
class myCliImagickConvertor implements myImageProcessor{
  
  public function generateThumbnail($original_path, $generated_path, $width = 200, $height = 200, $type = myImageCodes::NORMAL) {
	$options = array();
	if($type == myImageCodes::NORMAL)
	{
	  $type = myImageCodes::RESIZECROP;
	}
	$options[myImageCodes::CODE] = $type;
	$options[myImageCodes::WIDTH] = $width;
	$options[myImageCodes::HEIGHT] = $height;
	$options[myImageCodes::FILE_CACHE_PATH] = $generated_path;
	myFileMagickHandler::process($original_path, $options);
	
  }
  
}

