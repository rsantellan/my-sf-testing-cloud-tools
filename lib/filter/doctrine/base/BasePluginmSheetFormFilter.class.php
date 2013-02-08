<?php

/**
 * PluginmSheet filter form base class.
 *
 * @package    testing
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePluginmSheetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'm_instrument_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('mInstrument'), 'add_empty' => true)),
      'm_song_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('mSong'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'm_instrument_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('mInstrument'), 'column' => 'id')),
      'm_song_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('mSong'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('pluginm_sheet_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PluginmSheet';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'm_instrument_id' => 'ForeignKey',
      'm_song_id'       => 'ForeignKey',
    );
  }
}
