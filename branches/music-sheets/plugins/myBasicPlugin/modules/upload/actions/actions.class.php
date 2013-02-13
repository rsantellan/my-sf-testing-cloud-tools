<?php

/**
 * upload actions.
 *
 * @package    testing
 * @subpackage upload
 * @author     Rodrigo Santellan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class uploadActions extends sfActions {

  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request) {
    $this->forward('default', 'module');
  }

  public function executeReloadAlbum(sfWebRequest $request) {
    $id = $request->getPostParameter("id");
    
    $images = myAlbumHandler::retrieveAlbumContent($id);
    $partial = $this->getPartial("upload/albumImages", array("uploades" => $images));
    return $this->renderText(myBasicHandler::JsonResponse(true, array("body" => $partial)));
  }
  
  public function executeDeleteFile(sfWebRequest $request) {
	$is_ok = true;
	$id = $request->getPostParameter("id", null);
	if(!is_null($id))
	{
      myAlbumHandler::deleteAlbumObject($id);
	}
	return $this->renderText(myBasicHandler::JsonResponse($is_ok, array("id" => $id)));
  }
  
  public function executeEditarImagen(sfWebRequest $request) 
  {
    $this->obj = myAlbumHandler::retrieveConcreteObjectWithMyMediaContentId($request->getParameter("id"));
    $this->forward404Unless($this->obj);
    if($this->obj->getObjectClass() == "myUploaded")
    {
      $this->form = new myUploadedForm($this->obj);
    }
    else 
    {
      $this->form = new myAlbumVideoForm($this->obj);
      $this->setTemplate('editOnlineVideos');
    }
    
    
    
  }
  
  public function executeSaveImagen(sfWebRequest $request) 
  {
    $auxForm = new myUploadedForm();
    $parameters = $request->getParameter($auxForm->getName());
    $id = $parameters["id"];
    $file = Doctrine::getTable('myUploaded')->find($id);
    $this->forward404Unless($file);
    $form = new myUploadedForm($file);
    $form->bind($parameters);
    if ($form->isValid())
    {
      $file = $form->save();
      $form = new myUploadedForm($file);
      $body = $this->getPartial('imageEditForm', array('form'=>$form));
      return $this->renderText(myBasicHandler::JsonResponse(true, array('body' => $body)));
    }
    else
    {
      $body = $this->getPartial('imageEditForm', array('form'=>$form));
      return $this->renderText(myBasicHandler::JsonResponse(false, array('body' => $body)));
    }
  }
  
  public function executeDownloadData(sfWebRequest $request)
  {
    $file = Doctrine::getTable("myUploaded")->find($request->getParameter("id"));
    $this->forward404Unless($file);
    $download = $file->getDownloadSource();
    $file_name = $file->getName();
    $file_extension = $file->getFileType();
    $this->output_file(sfConfig::get('sf_upload_dir').$download, $file_name, $file_extension);
    return $this->renderText("");
  }
  
  private function output_file($file, $name, $mime_type='') 
  {
      /*
        This function takes a path to a file to output ($file),
        the filename that the browser will see ($name) and
        the MIME type of the file ($mime_type, optional).

        If you want to do something on download abort/finish,
        register_shutdown_function('function_name');
       */
      //print_r($file);
      if (!is_readable($file))
          die('File not found or inaccessible!');

      $size = filesize($file);
      $name = rawurldecode($name);

      /* Figure out the MIME type (if not specified) */
      $known_mime_types = array(
          "pdf" => "application/pdf",
          "txt" => "text/plain",
          "html" => "text/html",
          "htm" => "text/html",
          "exe" => "application/octet-stream",
          "zip" => "application/zip",
          "doc" => "application/msword",
          "xls" => "application/vnd.ms-excel",
          "ppt" => "application/vnd.ms-powerpoint",
          "gif" => "image/gif",
          "png" => "image/png",
          "jpeg" => "image/jpg",
          "jpg" => "image/jpg",
          "php" => "text/plain"
      );

      if ($mime_type == '') {
          $file_extension = strtolower(substr(strrchr($file, "."), 1));
          if (array_key_exists($file_extension, $known_mime_types)) {
              $mime_type = $known_mime_types[$file_extension];
          } else {
              $mime_type = "application/force-download";
          };
      };

      @ob_end_clean(); //turn off output buffering to decrease cpu usage
      // required for IE, otherwise Content-Disposition may be ignored
      if (ini_get('zlib.output_compression'))
          ini_set('zlib.output_compression', 'Off');

      header('Content-Type: ' . $mime_type);
      header('Content-Disposition: attachment; filename="' . $name . '"');
      header("Content-Transfer-Encoding: binary");
      header('Accept-Ranges: bytes');

      /* The three lines below basically make the
        download non-cacheable */
      header("Cache-control: private");
      header('Pragma: private');
      header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

      // multipart-download and download resuming support
      if (isset($_SERVER['HTTP_RANGE'])) {
          list($a, $range) = explode("=", $_SERVER['HTTP_RANGE'], 2);
          list($range) = explode(",", $range, 2);
          list($range, $range_end) = explode("-", $range);
          $range = intval($range);
          if (!$range_end) {
              $range_end = $size - 1;
          } else {
              $range_end = intval($range_end);
          }

          $new_length = $range_end - $range + 1;
          header("HTTP/1.1 206 Partial Content");
          header("Content-Length: $new_length");
          header("Content-Range: bytes $range-$range_end/$size");
      } else {
          $new_length = $size;
          header("Content-Length: " . $size);
      }

      /* output the file itself */
      $chunksize = 1 * (1024 * 1024); //you may want to change this
      $bytes_send = 0;
      if ($file = fopen($file, 'r')) {
          if (isset($_SERVER['HTTP_RANGE']))
              fseek($file, $range);

          while (!feof($file) &&
          (!connection_aborted()) &&
          ($bytes_send < $new_length)
          ) {
              $buffer = fread($file, $chunksize);
              print($buffer); //echo($buffer); // is also possible
              flush();
              $bytes_send += strlen($buffer);
          }
          fclose($file);
      } else
          die('Error - can not open file.');

      die();
  }
  
  public function executeOrdenarAlbum(sfWebRequest $request) 
  {
    $this->albumId = $request->getParameter('i', 0);
    $this->images = myAlbumHandler::retrieveAlbumContent($this->albumId);
    
    $this->setLayout(ProjectConfiguration::getActive()->getTemplateDir('upload', 'clean.php') . DIRECTORY_SEPARATOR . "clean");
  }
  
  public function executeOrdenarAlbumProcesado(sfWebRequest $request)
  {
    $albumId = $request->getPostParameter("album_id");
    $lista = $request->getPostParameter("listItem");
    //$cantidad = count($lista) - 1;
    
    $maximo = count($lista) - 1;
    $cantidad = 0;
    while($cantidad <= $maximo)
    {
      myAlbumHandler::updateOrfinalOfUploaded($lista[$maximo - $cantidad], $cantidad);
      //$obj->updateInteresesOrder($lista[$maximo - $cantidad], $cantidad);
      $cantidad ++;
    }
    
    return $this->renderText(myBasicHandler::JsonResponse(true, array()));
    /*  
    while($cantidad >= 0)
    {
      //echo $lista[$cantidad] . " - ".$cantidad;
      //$this->images->updateOrder($lista[$cantidad], $cantidad);
      $cantidad --;
    }
    */
  }
  
  public function executeUpload(sfWebRequest $request) {
    //$this->objectId = $request->getParameter('a', 0);
    $this->objectClass = $request->getParameter('c', '');
    $this->album_id = $request->getParameter('i', '');
    $album = Doctrine::getTable("myAlbum")->find($this->album_id);
    $types = sfConfig::get( 'sf_plugins_upload_content_type_' . $this->objectClass, '*.jpg;*.jpeg;*.gif;*.png;*.JPG;*.JPEG;*.GIF;*.PNG' );
    if($album)
    {
      if($album->getType() == myAlbumHandler::ONLINEVIDEOS)
      {
        $this->setTemplate('onlineVideos');
        $aux = new MyAlbumVideo();
        $aux->setMyAlbum($album);
        $aux->setUserId($this->getUser()->getUserId());
        $this->form = new myAlbumVideoForm($aux);
      }
      if($album->getAllowedTypes() != "" || !is_null($album->getAllowedTypes()))
      {
        $types = $album->getAllowedTypes();
      }
    }
    $this->allowed_types = $types;
    
    
    $this->setLayout(ProjectConfiguration::getActive()->getTemplateDir('upload', 'clean.php') . DIRECTORY_SEPARATOR . "clean");
    //$this->setLayout(ProjectConfiguration::getActive()->getTemplateDir('mdMediaContentAdmin', 'clean.php').'/clean');
  }


  public function executeSaveOnlineVideo(sfWebRequest $request) 
  {
    $this->form = new myAlbumVideoForm();
    $this->form->bind($request->getParameter($this->form->getName()));
    if ($this->form->isValid())
    {
      $this->form->save();
    }
    $this->setTemplate('onlineVideos');
    $this->setLayout(ProjectConfiguration::getActive()->getTemplateDir('upload', 'clean.php') . DIRECTORY_SEPARATOR . "clean");
  }
  
  public function executeUploadContent(sfWebRequest $request) {
    
      if (!$this->getUser()->isAuthenticated()) {
      throw new Exception('No esta autentificado', 100);
      }
     
    try {
      $uploaded = $this->upload($_FILES, $request->getParameter('objClass'), $request->getParameter('album_id'), $request->getParameter('filename'));
      $this->setLayout(false);
      
      //$url = $mdMediaContentConcrete->getObjectUrl(array('width' => $request->getParameter('w'), 'height' => $request->getParameter('h')));

      sfConfig::set('sf_web_debug', false);
      $this->setLayout(false);
      return $this->renderText("OK");
      //return $this->renderText($url . '|' . $mdMediaContentConcrete->retrieveMdMediaContent()->getId());
    } catch (Exception $e) {
      sfContext::getInstance()->getLogger()->log('>>>>>>> ' . $e->getMessage());
      echo $e->getMessage();
    }
  }

  private function upload($FILES, $object_class, $album_id, $filename) {
    try {

      //$mdObject = Doctrine::getTable($object_class)->find($object_id);

      //$path = $mdObject->getPath();

      $path = DIRECTORY_SEPARATOR.$object_class.DIRECTORY_SEPARATOR.$album_id;
      $file_name = myFileHandler::upload($FILES, sfConfig::get('sf_upload_dir') . $path);

      //Obtenemos el usuario logueado
      //$mdUser = $this->getUser()->getMdPassport()->getMdUser();
      $upload_name = "upload";

      $path_info = pathinfo($FILES [$upload_name] ['name']);
      $file_extension = $path_info ["extension"];
      $name = $filename;
      $album_id = (int) $album_id;

      $options = array('name' => $name, 'filename' => $file_name, 'type' => $file_extension, 'album' => $album_id, 'object_class'=>$object_class, 'path' => $path, 'description' => "");

      $uploaded = myAlbumHandler::saveUploadedFileToAlbum($album_id, $options, $this->getUser()->getUserId());
      //Damos de alta las imagenes del usuario $mdUser al contenido $mdObject salvado anteriormente
      //$mdMedia = $mdObject->retrieveMdMedia();
      //$mdMediaContentConcrete = $mdMedia->upload($mdUser, $mdObject, $options);

      /*
      if ($album_id == 0) {
        $album = Doctrine::getTable('mdMediaAlbum')->retrieveAlbum($mdMedia->getId(), mdMedia::$default);
        $album_id = (int) $album['id'];
      }
      */
      //$this->dispatcher->notify(new sfEvent($this, $this->retrieveSignal($file_extension), array('contents' => array($mdMediaContentConcrete->retrieveMdMediaContent()), 'album_id' => $album_id)));

      return $uploaded;//$mdMediaContentConcrete;
    } catch (Exception $e) {

      throw $e;
    }
  }

}
