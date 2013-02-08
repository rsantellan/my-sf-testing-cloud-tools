<?php

/**
 * mSong form base class.
 *
 * @method mSong getObject() Returns the current form's model object
 *
 * @package    testing
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasemSongForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'name'                => new sfWidgetFormInputText(),
      'fecha_publicacion'   => new sfWidgetFormDate(),
      'remix'               => new sfWidgetFormChoice(array('choices' => array('si' => 'si', 'no' => 'no', 'no sabe' => 'no sabe'))),
      'm_group_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('mGroup'), 'add_empty' => false)),
      'm_group_original_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('mGroupOriginal'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                => new sfValidatorString(array('max_length' => 255)),
      'fecha_publicacion'   => new sfValidatorDate(array('required' => false)),
      'remix'               => new sfValidatorChoice(array('choices' => array(0 => 'si', 1 => 'no', 2 => 'no sabe'), 'required' => false)),
      'm_group_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('mGroup'))),
      'm_group_original_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('mGroupOriginal'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('m_song[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'mSong';
  }

}
