<?php

/*
 */

/**
 * Description of myCacheHandler
 *
 * @author Rodrigo Santellan <rodrigo.santellan at inswitch.us>
 */
class myCacheHandler 
{

  public static function createCacheImage($route, $options = array())
  {
    $cache_path = self::getCacheFile($route, $options);
    sfContext::getInstance()->getLogger()->info('>>>>>>> cache path >>>>>>>>>>' . $cache_path);
    //Aca tendria que ir probando los distintos handlers de imagenes para crearlas.
    if(!file_exists($cache_path))
    {
      
      $handler = myImageFactory::returnImageLibrary();
      $handler->generateThumbnail($route, $cache_path, $options[myImageCodes::WIDTH], $options[myImageCodes::HEIGHT], $options[myImageCodes::CODE]);
    }
    return $cache_path;
  }
  
  /**
   *
   * @param type $route
   * @param array $options
   *            - code : El codigo que tiene que tener la imagen
   *            - width: El ancho de la imagen.
   *            - height: El alto de la imagen.
   * @return type 
   */
  public static function getCacheFile($route, $options)
  {
    $cacheFileName = basename($route);

    $cachePath = sfConfig::get('sf_cache_dir') . '/images/web';

    $dirName = dirname($route);

    $cacheDir = str_replace(sfConfig::get ( 'sf_web_dir' ), $cachePath, $dirName);

    $codeName = '/' . $options[myImageCodes::CODE] . '_' . (isset($options[myImageCodes::WIDTH]) ? $options[myImageCodes::WIDTH] : '') . 'X' . (isset($options[myImageCodes::HEIGHT]) ? $options[myImageCodes::HEIGHT] : '');

    $cacheDir = myFileHandler::checkDirectory($cacheDir . $codeName);
    //$cacheDir = MdFileHandler::checkDirectory($cacheDir . $codeName);

    return $cacheDir . $cacheFileName;
  }  
}


