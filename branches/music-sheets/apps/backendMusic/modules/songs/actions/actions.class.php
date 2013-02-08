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
    $this->form = new mSongForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $aux = new mSongForm();
    
    $parameters = $request->getParameter($aux->getName());
    $mGroup = Doctrine::getTable('mGroup')->findOneBy("name", $parameters ["m_group_id"]);
    if(!$mGroup)
    {
      $mGroup = new mGroup();
      $mGroup->setName($parameters ["m_group_id"]);
      $mGroup->save();
      $mGroup = Doctrine::getTable('mGroup')->findOneBy("name", $parameters ["m_group_id"]);
    }
    $auxSong = new mSong();
    $auxSong->setMGroup($mGroup);
    var_dump($auxSong->toArray());
    var_dump($parameters ["m_group_id"]);
    $parameters ["m_group_id"] = $mGroup->getId();
    var_dump($parameters ["m_group_id"]);
    //die;
    $this->form = new mSongForm($auxSong);

    $this->processForm($request, $this->form, $parameters);

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
