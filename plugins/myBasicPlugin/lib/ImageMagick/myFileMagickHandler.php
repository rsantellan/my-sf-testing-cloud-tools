<?php
class myFileMagickHandler
{

    /**
     * Se encarga de procesar la imagen creandola en caso de ser necesario
     * segun los parametros pasados en $options.
     *
     * La funcion devuelve la ruta a la imagen procesada
     *
     * @param <string> $route, path de la imagen original
     * @param <array> $options, opciones para procesar la imagen, ejemplo:
     *  $options['code']  => 'resize';
     *  $options['width'] => 60;
     *  $options['heigth']=> 60;
     *  $options['exactDimentions'] => 1;
	 *  $options['cache_file_path'] => 'file'
     * @return <string>
     */
    public static function process($route, $options)
    {
        self::myLog(" ruta :".$route);
        if(!isset($options[myImageCodes::CODE]) )
        {
            if(isset($options[myImageCodes::WIDTH]) || isset($options[myImageCodes::HEIGHT]))
            {

                $options[myImageCodes::CODE] = myImageCodes::RESIZE;
            }
            
        }
        self::myLog(" codigo :".$options[myImageCodes::CODE]);
        if($options[myImageCodes::CODE] == myImageCodes::ORIGINAL)
        {
            return $route; //devolver ruta original
        }        
        
        try{
			$cacheFile  = "";
			if(isset($options[myImageCodes::FILE_CACHE_PATH]))
			{
			  $cacheFile  = $options[myImageCodes::FILE_CACHE_PATH];
			}
			else
			{
			  $cacheFile  = myCacheHandler::getCacheFile($route, $options);
			}
            self::myLog(" archivo en el cache :".$options[myImageCodes::CODE]);

            if(!file_exists($cacheFile))
            {
                $myMagick   = new myMagick($route, $cacheFile);
                if( sfConfig::get( 'sf_image_quality_change', false ) )
                {
                    $cuality = (int) sfConfig::get( 'sf_image_quality_porcent', 75 ) ;
                    $myMagick->setImageQuality($cuality);
                }
                switch($options[myImageCodes::CODE])
                {
                    case myImageCodes::RESIZE:

                        list($width, $height, $exactDimentions) = self::processParameters($options);

                        $myMagick->resize($width, $height, $exactDimentions);

                        break;
                    case myImageCodes::RESIZECROP:

                        list($width, $height) = self::processParameters($options);

                        $myMagick->resizeExactly($width, $height);

                        break;

	                  case myImageCodes::CROPRESIZE:
	                       list($width, $height) = self::processParameters($options);

	                       $myMagick->cropresize($width, $height);

	                       break;

                    case myImageCodes::PERSPECTIVE:

                        throw new Exception('operation not implemented yet', 102);

                        break;
                    case myImageCodes::ROUND_CORNERS:

                            list($round) = self::processParameters($options);

                            $myMagick->roundCorners($round);
                            
                        break;
                    case myImageCodes::CROP:

                            list($width, $height, $top, $left, $gravity) = self::processParameters($options);

                            $myMagick->crop($width, $height, $top, $left, $gravity);

                       break;
                    default:

                        throw new Exception('operation not implemented yet', 102);

                        break;
                }

                if (is_readable($cacheFile))
                {
                    chmod($cacheFile, 0775);
                }
            }

            return $cacheFile;

        }catch(Exception $e){

            throw $e;
            
        }
        
    }

	/**
	 *
	 * Metodo para identificar el logueo
	 * @param String $message 
	 */
	private static function myLog($message)
	{
	  if( sfConfig::get( 'sf_plugins_myimagick_debug', false ) )
	  {
		sfContext::getInstance()->getLogger()->info(">>>>>>>>>> myFileMagickHandler >>>>>>>> ".$message);
	  }
	  
	}
	
    /**
     * Devuelve el binario de la imagen de path $path
     *
     * @param <string> $path
     * @return <binary>
     */
    public static function getFileGetContents($path)
    {
        if(file_exists($path))
        {
            return file_get_contents($path);
        }
        else
        {
            throw new Exception('no image', 100);
        }
    }

    /**
     * Procesa los parametros validandolos
     *
     * @param <array> $options
     * @return <array>
     */
    private static function processParameters($options)
    {
        $values = array();
        switch($options[myImageCodes::CODE])
        {
            case myImageCodes::RESIZE:

                if (isset($options[myImageCodes::WIDTH])) $width = $options[myImageCodes::WIDTH];
                else throw new Exception('no width given', 100);

                $height = (isset($options[myImageCodes::HEIGHT]) ? $options[myImageCodes::HEIGHT] : 0);

                $exactDimentions = ((isset($options[myImageCodes::EXACT_DIMENTIONS]) && $options[myImageCodes::EXACT_DIMENTIONS] == 'true') ? true : false);

                $values = array($width, $height, $exactDimentions);
                
                break;
            case myImageCodes::RESIZECROP:

                if (isset($options[myImageCodes::WIDTH])) $width = $options[myImageCodes::WIDTH];
                else throw new Exception('no width given', 100);

                if(isset($options[myImageCodes::HEIGHT])) $height = $options[myImageCodes::HEIGHT];
                else throw new Exception('no height given', 101);

                $values = array($width, $height);

                break;
          	case myImageCodes::CROPRESIZE:

                if (isset($options[myImageCodes::WIDTH])) $width = $options[myImageCodes::WIDTH];
                else $width = null; //throw new Exception('no width given', 100);

                if(isset($options[myImageCodes::HEIGHT])) $height = $options[myImageCodes::HEIGHT];
                else $height = null; //throw new Exception('no height given', 101);

                $values = array($width, $height);

                break;
            case myImageCodes::PERSPECTIVE:

                throw new Exception('operation not implemented yet', 102);

                break;
            case myImageCodes::ROUND_CORNERS:

                if(isset($options[myImageCodes::ROUND_CORNERS]))
                    
                break;
            case myImageCodes::CROP:
            
                if (isset($options[myImageCodes::WIDTH])) $width = $options[myImageCodes::WIDTH];
                else throw new Exception('no width given', 100);

                if(isset($options[myImageCodes::HEIGHT])) $height = $options[myImageCodes::HEIGHT] ;
                else throw new Exception('no height given', 101);
                    
                $top = ((isset($options[myImageCodes::TOP])) ? $options[myImageCodes::TOP] : 0);
                $left = ((isset($options[myImageCodes::LEFT])) ? $options[myImageCodes::LEFT] : 0);
                $gravity = ((isset($options[myImageCodes::GRAVITY])) ? $options[myImageCodes::GRAVITY] : myMagickGravity::None);
                
                $values = array($width, $height, $top, $left, $gravity);
                
                break;
            default:
                    throw new Exception('operation not implemented yet', 102);
                break;
        }
        return $values;
    }

}
