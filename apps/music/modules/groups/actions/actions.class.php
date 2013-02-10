<?php

/**
 * groups actions.
 *
 * @package    testing
 * @subpackage groups
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class groupsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->m_groups = Doctrine_Core::getTable('mGroup')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new mGroupForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new mGroupForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($m_group = Doctrine_Core::getTable('mGroup')->find(array($request->getParameter('id'))), sprintf('Object m_group does not exist (%s).', $request->getParameter('id')));
    $this->form = new mGroupForm($m_group);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($m_group = Doctrine_Core::getTable('mGroup')->find(array($request->getParameter('id'))), sprintf('Object m_group does not exist (%s).', $request->getParameter('id')));
    $this->form = new mGroupForm($m_group);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($m_group = Doctrine_Core::getTable('mGroup')->find(array($request->getParameter('id'))), sprintf('Object m_group does not exist (%s).', $request->getParameter('id')));
    $m_group->delete();

    $this->redirect('groups/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $m_group = $form->save();

      $this->redirect('groups/edit?id='.$m_group->getId());
    }
  }
}
