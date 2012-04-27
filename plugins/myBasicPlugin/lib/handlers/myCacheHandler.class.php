<?php

/*
 */

/**
 * Description of myCacheHandler
 *
 * @author Rodrigo Santellan <rodrigo.santellan at inswitch.us>
 */
class myCacheHandler {

  public static function createCacheImage($route, $options = array()) {
	$cache_path = self::getCacheFile($route, $options);
	sfContext::getInstance()->getLogger()->info('>>>>>>> cache path >>>>>>>>>>' . $cache_path);
	//Aca tendria que ir probando los distintos handlers de imagenes para crearlas.
	if (!file_exists($cache_path)) {

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
  public static function getCacheFile($route, $options) {
	$cacheFileName = basename($route);

	$cachePath = sfConfig::get('sf_cache_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'web';

	$dirName = dirname($route);

	$cacheDir = str_replace(sfConfig::get('sf_web_dir'), $cachePath, $dirName);

	$codeName = DIRECTORY_SEPARATOR . $options[myImageCodes::CODE] . '_' . (isset($options[myImageCodes::WIDTH]) ? $options[myImageCodes::WIDTH] : '') . 'X' . (isset($options[myImageCodes::HEIGHT]) ? $options[myImageCodes::HEIGHT] : '');

	$cacheDir = myFileHandler::checkDirectory($cacheDir . $codeName);
	//$cacheDir = MdFileHandler::checkDirectory($cacheDir . $codeName);

	return $cacheDir . $cacheFileName;
  }

  public static function removeCacheOfFile($route) {
    sfContext::getInstance()->getLogger()->info('>>>>>>> myCacheHandler removeCacheOfFile >>>>>>>>>> ---- route' . $route);
    $cacheFileName = basename($route);
    sfContext::getInstance()->getLogger()->info('>>>>>>> myCacheHandler removeCacheOfFile >>>>>>>>>> ---- cacheFileName' . $cacheFileName);
    $root = sfConfig::get('sf_cache_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'web';
    sfContext::getInstance()->getLogger()->info('>>>>>>> myCacheHandler removeCacheOfFile >>>>>>>>>> ---- root' . $root);
    $dirName = dirname($route);
    sfContext::getInstance()->getLogger()->info('>>>>>>> myCacheHandler removeCacheOfFile >>>>>>>>>> ---- dirName' . $dirName);
    $cacheDir = str_replace(sfConfig::get('sf_web_dir'), $root, $dirName);

    $path = $cacheDir;
    
    sfContext::getInstance()->getLogger()->info('>>>>>>> myFileHandler delete >>>>>>>>>> ---- path: ' . $path);
    
    self::findAndRemoveFile($path, $cacheFileName);
  }

  private static function findAndRemoveFile($path, $fileName) {
    sfContext::getInstance()->getLogger()->info('>>>>>>> findAndRemoveFile >>>>>>>>>>' . $path);
    if (is_dir($path)) {
      //using the opendir function
      $dir_handle = @opendir($path);// or die("Unable to open " . $path);
      if($dir_handle === FALSE)
      {
        sfContext::getInstance()->getLogger()->error('>>>>>>> Unable to open >>>>>>>>>>' . $path);
        throw new Exception("Unable to open directory myCacheHandler::findAndRemoveFile", 190);
      }
      sfContext::getInstance()->getLogger()->info('>>>>>>> findAndRemoveFile >>>>>>>>>>' . $path);
      //running the while loop
      while (false !== ($file = readdir($dir_handle))) {
      if ($file != "." && $file != "..") {
        if (is_dir($path . DIRECTORY_SEPARATOR . $file)) {
        self::findAndRemoveFile($path . DIRECTORY_SEPARATOR . $file, $fileName);
        } else {
        if ($file == $fileName) {
          if (!unlink($path . DIRECTORY_SEPARATOR . $fileName)) {
          throw new Exception('image not deleted of cache', 150);
          }
        }
        }
      }
      }
      //closing the directory
      closedir($dir_handle);
    }
    else
    {
      sfContext::getInstance()->getLogger()->info('>>>>>>> findAndRemoveFile: esto no es un path. >>>>>>>>>>' . $path);
    }
  }

}

