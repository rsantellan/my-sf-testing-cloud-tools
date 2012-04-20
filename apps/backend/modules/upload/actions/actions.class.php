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

  public function executeUpload(sfWebRequest $request) {
	$this->objectId = $request->getParameter('a', 0);
	$this->objectClass = $request->getParameter('c', '');
	$this->album_id = $request->getParameter('i', '');

//	$type = $request->getParameter('t', mdMediaManager::MIXED);
//	try {
//	  $mdObject = Doctrine::getTable($this->objectClass)->find($this->objectId);
//	  mdMediaManager::$LOAD_ON_DEMAND_CONTENT = true;
//	  $this->manager = mdMediaManager::getInstance($type, $mdObject)->load();
//
//	  if ($this->album_id == '') {
//		if ($this->manager->getCountAlbums() > 1) {
//		  $albums = $this->manager->getAlbums();
//		  $album = array_shift($albums);
//		  $this->album_id = $album->id;
//		}
//	  }
//	} catch (Exception $e) {
//	  print_r($e->getMessage());
//	}
	$this->setLayout(ProjectConfiguration::getActive()->getTemplateDir('upload', 'clean.php').DIRECTORY_SEPARATOR."clean");
	//$this->setLayout(ProjectConfiguration::getActive()->getTemplateDir('mdMediaContentAdmin', 'clean.php').'/clean');
  }

}
