<?php

/**
 * mSong filter form base class.
 *
 * @package    testing
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasemSongFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_ingreso_lista' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'remix'               => new sfWidgetFormChoice(array('choices' => array('' => '', 'si' => 'si', 'no' => 'no', 'no sabe' => 'no sabe'))),
      'm_group_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('mGroup'), 'add_empty' => true)),
      'm_group_original_id' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'                => new sfValidatorPass(array('required' => false)),
      'fecha_ingreso_lista' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'remix'               => new sfValidatorChoice(array('required' => false, 'choices' => array('si' => 'si', 'no' => 'no', 'no sabe' => 'no sabe'))),
      'm_group_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('mGroup'), 'column' => 'id')),
      'm_group_original_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('m_song_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'mSong';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'name'                => 'Text',
      'fecha_ingreso_lista' => 'Date',
      'remix'               => 'Enum',
      'm_group_id'          => 'ForeignKey',
      'm_group_original_id' => 'Number',
    );
  }
}
