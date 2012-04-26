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
  
  
  public function executeUpload(sfWebRequest $request) {
    //$this->objectId = $request->getParameter('a', 0);
    $this->objectClass = $request->getParameter('c', '');
    $this->album_id = $request->getParameter('i', '');
    $this->setLayout(ProjectConfiguration::getActive()->getTemplateDir('upload', 'clean.php') . DIRECTORY_SEPARATOR . "clean");
    //$this->setLayout(ProjectConfiguration::getActive()->getTemplateDir('mdMediaContentAdmin', 'clean.php').'/clean');
  }

  public function executeDeleteFile(sfWebRequest $request) {
	$is_ok = true;
	$id = $request->getPostParameter("id", null);
	if(!is_null($id))
	{
	  $file = Doctrine::getTable("myUploaded")->find($id);
	  $file->delete();
	}
	return $this->renderText(myBasicHandler::JsonResponse($is_ok, array("id" => $id)));
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

      $uploaded = myAlbumHandler::saveUploadedFileToAlbum($album_id, $options);
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
