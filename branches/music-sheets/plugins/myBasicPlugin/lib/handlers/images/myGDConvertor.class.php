<?php

/*
 */

/**
 * Description of myGDConvertor
 *
 * @author Rodrigo Santellan <rodrigo.santellan at inswitch.us>
 */
class myGDConvertor implements myImageProcessor{
  
  public function generateThumbnail($original_path, $generated_path, $width = 200, $height = 200, $type = myImageCodes::NORMAL) 
  {
    //$this->basicThumbnail($original_path, $generated_path, $type, $width, $height);
	
	$ext = exif_imagetype($original_path);
	switch ($ext) {
	  case IMAGETYPE_JPEG:
         $src = @imagecreatefromjpeg($original_path);
		// Capture the original size of the uploaded image
		//list($width,$height)=@getimagesize($uploadedfile);
		// The image is resized, while keeping the height and width ratio intact
		$newwidth=$width;
		$newheight=($height/$width) * $height;
		$tmp=@imagecreatetruecolor($newwidth,$newheight);
		// this line resizes the image, copying the original image into $tmp
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		// The resized image is written to disk.
		imagejpeg($tmp,$generated_path,100);
		imagedestroy($src);
		imagedestroy($tmp);
		break;

	  default:
		break;
	}
  }

  
}


