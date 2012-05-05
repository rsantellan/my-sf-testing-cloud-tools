<?php

/**
 * mTest actions.
 *
 * @package    testing
 * @subpackage mTest
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mTestActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	
	$this->my_tests = Doctrine_Core::getTable('myTest')
      ->createQuery('a')
      ->execute();
    //myAlbumHandler::retrieveLastAlbumPriority(1);
    //myAlbumHandler::createAlbum(1, "test");
    
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->my_test = Doctrine_Core::getTable('myTest')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->my_test);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new myTestForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new myTestForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($my_test = Doctrine_Core::getTable('myTest')->find(array($request->getParameter('id'))), sprintf('Object my_test does not exist (%s).', $request->getParameter('id')));
    $this->form = new myTestForm($my_test);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($my_test = Doctrine_Core::getTable('myTest')->find(array($request->getParameter('id'))), sprintf('Object my_test does not exist (%s).', $request->getParameter('id')));
    $this->form = new myTestForm($my_test);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($my_test = Doctrine_Core::getTable('myTest')->find(array($request->getParameter('id'))), sprintf('Object my_test does not exist (%s).', $request->getParameter('id')));
    $my_test->delete();

    $this->redirect('mTest/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $my_test = $form->save();

      $this->redirect('mTest/edit?id='.$my_test->getId());
    }
  }
}
