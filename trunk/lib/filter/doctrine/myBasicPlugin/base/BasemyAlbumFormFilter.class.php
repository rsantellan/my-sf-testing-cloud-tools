<?php

/**
 * myAlbum filter form base class.
 *
 * @package    testing
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasemyAlbumFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'       => new sfWidgetFormFilterInput(),
      'type'              => new sfWidgetFormChoice(array('choices' => array('' => '', 'Image' => 'Image', 'Video' => 'Video', 'File' => 'File', 'Mixed' => 'Mixed'))),
      'deleteAllowed'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'my_file_id'        => new sfWidgetFormFilterInput(),
      'object_class_name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'object_id'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'title'             => new sfValidatorPass(array('required' => false)),
      'description'       => new sfValidatorPass(array('required' => false)),
      'type'              => new sfValidatorChoice(array('required' => false, 'choices' => array('Image' => 'Image', 'Video' => 'Video', 'File' => 'File', 'Mixed' => 'Mixed'))),
      'deleteAllowed'     => new sfValidatorPass(array('required' => false)),
      'my_file_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'object_class_name' => new sfValidatorPass(array('required' => false)),
      'object_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('my_album_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'myAlbum';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'title'             => 'Text',
      'description'       => 'Text',
      'type'              => 'Enum',
      'deleteAllowed'     => 'Text',
      'my_file_id'        => 'Number',
      'object_class_name' => 'Text',
      'object_id'         => 'Number',
    );
  }
}
