<?php

/*
 */

/**
 *
 * @author Rodrigo Santellan <rodrigo.santellan at inswitch.us>
 */
interface myImageProcessor {
  
  public function generateThumbnail($original_path, $generated_path, $width = 200, $height = 200, $type = myImageCodes::NORMAL);
          
}


