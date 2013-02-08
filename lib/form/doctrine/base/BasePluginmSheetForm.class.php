<?php

/**
 * PluginmSheet form base class.
 *
 * @method PluginmSheet getObject() Returns the current form's model object
 *
 * @package    testing
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePluginmSheetForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'm_instrument_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('mInstrument'), 'add_empty' => false)),
      'm_song_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('mSong'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'm_instrument_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('mInstrument'))),
      'm_song_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('mSong'))),
    ));

    $this->widgetSchema->setNameFormat('pluginm_sheet[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PluginmSheet';
  }

}
