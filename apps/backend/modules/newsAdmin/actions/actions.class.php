<?php

/**
 * newsAdmin actions.
 *
 * @package    testing
 * @subpackage newsAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class newsAdminActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->my_news = Doctrine_Core::getTable('myNew')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new myNewForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new myNewForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }
  
  public function executeShowDetail(sfWebRequest $request)
  {
    $this->forward404Unless($this->my_new = Doctrine_Core::getTable('myNew')->find(array($request->getParameter('id'))), sprintf('Object my_new does not exist (%s).', $request->getParameter('id')));
    
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($my_new = Doctrine_Core::getTable('myNew')->find(array($request->getParameter('id'))), sprintf('Object my_new does not exist (%s).', $request->getParameter('id')));
    $this->form = new myNewForm($my_new);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($my_new = Doctrine_Core::getTable('myNew')->find(array($request->getParameter('id'))), sprintf('Object my_new does not exist (%s).', $request->getParameter('id')));
    $this->form = new myNewForm($my_new);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($my_new = Doctrine_Core::getTable('myNew')->find(array($request->getParameter('id'))), sprintf('Object my_new does not exist (%s).', $request->getParameter('id')));
    $my_new->delete();

    $this->redirect('newsAdmin/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $my_new = $form->save();

      $this->redirect('newsAdmin/edit?id='.$my_new->getId());
    }
  }
}
