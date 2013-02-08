<?php

/*
 */

/**
 * Description of myCopyConvertor
 * Lo unico que hace es copiar la original al cache.
 *
 * @author Rodrigo Santellan <rodrigo.santellan at inswitch.us>
 */
class myCopyConvertor implements myImageProcessor{
  
  public function generateThumbnail($original_path, $generated_path, $width = 200, $height = 200, $type = myImageCodes::NORMAL) 
  {
    copy($original_path, $generated_path);
  }

  
}


