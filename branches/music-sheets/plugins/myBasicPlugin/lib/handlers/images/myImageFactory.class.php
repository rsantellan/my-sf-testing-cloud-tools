<?php

/*
 */

/**
 * Description of myImageFactory
 *
 * @author Rodrigo Santellan <rodrigo.santellan at inswitch.us>
 */
class myImageFactory {
  
  public static function returnImageLibrary()
  {
    $class = sfConfig::get('app_image_library');
    return new $class;
  }
}


