<?php

/**
 * songs actions.
 *
 * @package    testing
 * @subpackage songs
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class songsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->m_songs = Doctrine_Core::getTable('mSong')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
	$auxForm = new mSong();
	$auxForm->setUserId($this->getUser()->getUserId());
    $this->form = new mSongForm($auxForm);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new mSongForm();

    $this->processForm($request, $this->form, $request->getParameter($this->form->getName()));

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($m_song = Doctrine_Core::getTable('mSong')->find(array($request->getParameter('id'))), sprintf('Object m_song does not exist (%s).', $request->getParameter('id')));
    $this->form = new mSongForm($m_song);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($m_song = Doctrine_Core::getTable('mSong')->find(array($request->getParameter('id'))), sprintf('Object m_song does not exist (%s).', $request->getParameter('id')));
    $this->form = new mSongForm($m_song);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($m_song = Doctrine_Core::getTable('mSong')->find(array($request->getParameter('id'))), sprintf('Object m_song does not exist (%s).', $request->getParameter('id')));
    $m_song->delete();

    $this->redirect('songs/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form, $parameters)
  {
    $form->bind($parameters, $request->getFiles($form->getName()));
    //var_dump($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $m_song = $form->save();

      $this->redirect('songs/edit?id='.$m_song->getId());
    }
  }
}
