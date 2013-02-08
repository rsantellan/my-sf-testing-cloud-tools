<?php

/**
 * mSong filter form base class.
 *
 * @package    testing
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasemSongFormFilter extends PluginmSongFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('m_song_filters[%s]');
  }

  public function getModelName()
  {
    return 'mSong';
  }
}
