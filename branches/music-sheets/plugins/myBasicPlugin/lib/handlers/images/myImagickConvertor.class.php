<?php

/*
 */

/**
 * Description of myImagickConvertor
 *
 * @author Rodrigo Santellan <rodrigo.santellan at inswitch.us>
 */
class myImagickConvertor implements myImageProcessor{
  
  public function generateThumbnail($original_path, $generated_path, $width = 200, $height = 200, $type = myImageCodes::NORMAL) 
  {
    $this->basicThumbnail($original_path, $generated_path, $type, $width, $height);
  }

  /**
   *
   * Esta funcion es experimental, no esta implementada en casi ningun servidor.
   * 
   * @param type $file
   * @param type $cacheFile
   * @param type $width
   * @param type $height 
   * @author Rodrigo Santellan
   */
  public function SeamCarving($file, $cacheFile, $width, $height) {
    $im = new Imagick($file);
    $im->liquidRescaleImage($width, $height, 3, 25);
    $im->writeImage($cacheFile);
  }

  /**
   *
   * Crear una miniatura basica de una imagen con fondo
   * 
   * @param type $file
   * @param type $cacheFile
   * @param type $width
   * @param type $height
   * @param type $color
   * @param type $extension 
   * @author Rodrigo Santellan
   */
  public function thumbnailWithBackground($file, $cacheFile, $width, $height, $color = myImageCodes::BLACK, $extension = myImageCodes::JPG) {
    $im = new Imagick($file);
    $im->thumbnailImage($width, $height, true);
    $canvas = new Imagick();
    $canvas->newImage($width, $height, $color, $extension);
    $geometry = $im->getImageGeometry();
    /* The overlay x and y coordinates */
    $x = ( $width - $geometry['width'] ) / 2;
    $y = ( $height - $geometry['height'] ) / 2;
    $canvas->compositeImage($im, imagick::COMPOSITE_OVER, $x, $y);
    $canvas->writeImage($cacheFile);
  }

  /**
   *
   * Hace una copia de la imagen como si fuera un espejo
   * 
   * @param type $file
   * @param type $cacheFile
   * @param type $width
   * @param type $opacity
   * @param type $color
   * @param type $extension 
   * @author Rodrigo Santellan
   */
  public function resizeAndCreteReflection($file, $cacheFile, $width = 200, $opacity = 0.3, $color = myImageCodes::BLACK, $extension = myImageCodes::PNG) {
    $im = new Imagick($file);
    $im->thumbnailImage($width, null);
    $im->borderImage("white", 5, 5);
    /* Clone the image and flip it */
    $reflection = $im->clone();
    $reflection->flipImage();
    /* Create gradient. It will be overlayd on the reflection */
    $gradient = new Imagick();
    /* Gradient needs to be large enough for the image and the borders */
    $gradient->newPseudoImage($reflection->getImageWidth() + 10, 
                              $reflection->getImageHeight() + 10, 
                              "gradient:transparent-black");
    
    /* Composite the gradient on the reflection */
    $reflection->compositeImage( $gradient, imagick::COMPOSITE_OVER, 0, 0 );
    /* Add some opacity */
    $reflection->setImageOpacity( $opacity );
    /* Create empty canvas */
    $canvas = new Imagick();
    /* Canvas needs to be large enough to hold the both images */
    $width = $im->getImageWidth() + 40;
    $height = ( $im->getImageHeight() * 2 ) + 30;
    $canvas->newImage( $width, $height, $color, $extension );
    /* Composite the original image and the reflection on the canvas */
    $canvas->compositeImage( $im, imagick::COMPOSITE_OVER, 20, 10 );
    $canvas->compositeImage( $reflection, imagick::COMPOSITE_OVER,
                        20, $im->getImageHeight() + 10 );
    $canvas->writeImage($cacheFile);
  }
  
  /**
   *
   * Crea un thumbnail de una imagen con bordes redondeados y una sombra
   * 
   * @param type $file
   * @param type $cacheFile
   * @param type $width
   * @param type $height
   * @param type $shadow 
   * @author Rodrigo Santellan
   */
  public function thumbnailWithRoundCorners($file, $cacheFile, $width = 100, $height = NULL, $shadowColor = myImageCodes::BLACK)
  {
    $im = new Imagick($file);
    if(is_null($height))
    {
      $im->thumbnailImage( $width, null );
    }
    else
    {
      $im->thumbnailImage($width, $height, true);
    }
    /* Round corners, web 2.0! */
    $im->roundCorners( 5, 5 );
    /* Clone the current object */
    $shadow = $im->clone();
    /* Set image background color to black (this is the color of the shadow) */
    
    $sigma = $width / 100;
    
    $sigma = $sigma * 1.5;
    
    $shadow->setImageBackgroundColor( new ImagickPixel( $shadowColor ) );
    /* Create the shadow */
    $shadow->shadowImage( 80, $sigma, 5, 5 );
    /* Imagick::shadowImage only creates the shadow. That is why the original image is composited over it */
    $shadow->compositeImage( $im, Imagick::COMPOSITE_OVER, 0, 0 );
    $shadow->writeImage($cacheFile);
  }
  
  /**
   *
   * Crea el efecto de un mejoramiento de foto al aplicarle un blur.
   * 
   * @param type $file
   * @param type $cacheFile 
   * @author Rodrigo Santellan
   */
  public function simpleEnaceImage($file, $cacheFile)
  {
    $im = new Imagick($file);
    /* Add some contrast */
    $im->contrastImage( 1 );
    /* Add some adaptive blur */
    $im->adaptiveBlurImage( 1, 1 );
    $im->writeImage($cacheFile);
  }
  
  /**
   *
   * Crea una especie de imagen sacado por una polaroid.
   * 
   * @param type $file
   * @param type $cacheFile
   * @param type $color 
   * @author Rodrigo Santellan
   */
  public function polaroidImage($file, $cacheFile, $color = myImageCodes::LIGHTBLUE)
  {
    $im = new Imagick($file);
    $draw = new ImagickDraw();
    /* Set the fill color */
    $draw->setFillColor( new ImagickPixel( $color ) );
    /* Create the polaroid image */
    $im->polaroidImage( $draw, 20 );
    $im->writeImage($cacheFile);
  }
  
  
  /**
   *
   * Es la libreria basica para crear thumbnails o mejor dicho resize de imagenes.
   * 
   * @param type $file
   * @param type $cacheFile
   * @param type $type
   * @param type $width
   * @param type $height
   * @return type 
   * @author Rodrigo Santellan
   */
  public function basicThumbnail($file, $cacheFile, $type = myImageCodes::NORMAL, $width = 200, $height = 200)
  {
    if($type != myImageCodes::NORMAL || $type != myImageCodes::FIT || $type != myImageCodes::FIXED || $type != myImageCodes::CROP)
    {
      $type = myImageCodes::NORMAL;
    }
    $im = new Imagick($file);
    switch($type)
    {
      case myImageCodes::NORMAL:
        $im->thumbnailImage( $width, null );
        break;
      case myImageCodes::FIT:
        $im->thumbnailImage( $width, $height, true );
        break;
      case myImageCodes::FIXED:
        $im->thumbnailImage( $width, $height);
        break;
      case myImageCodes::CROP:
        $im->cropThumbnailImage( $width, $height);
        break;
      default:
        return false;
        break;
    }
    $im->writeImage($cacheFile);
  }
  
  
  public function watermarking($file, $cacheFile, $text = "Copyright", $font_size = 30, $rotation = 0, $gravity = Imagick::GRAVITY_CENTER)
  {
    $im = new Imagick($file);
    /* Create a drawing object and set the font size */
    $draw = new ImagickDraw();
    $draw->setFontSize( $font_size );
    
    /* Make the watermark semi-transparent */
    $draw->setFillAlpha( 0.4 );
    /* Set gravity to the center. More about gravity: http://www.imagemagick.org/Usage/annotating/#gravity */
    $draw->setGravity( $gravity );
    
    /* 
    Write the text on the image 
    Position x0,y0 (Because gravity is set to center)
    Rotation 45 degrees.
    */
    $im->annotateImage( $draw, 0, 0, $rotation, $text );
    $im->writeImage($cacheFile);
  }
  
}


