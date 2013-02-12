<?php

/**
 * myMediaContent filter form base class.
 *
 * @package    testing
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasemyMediaContentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'object_class_name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'object_id'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'priority'          => new sfWidgetFormFilterInput(),
      'my_album_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('myAlbum'), 'add_empty' => true)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'object_class_name' => new sfValidatorPass(array('required' => false)),
      'object_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'priority'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'my_album_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('myAlbum'), 'column' => 'id')),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('my_media_content_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'myMediaContent';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'object_class_name' => 'Text',
      'object_id'         => 'Number',
      'priority'          => 'Number',
      'my_album_id'       => 'ForeignKey',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
