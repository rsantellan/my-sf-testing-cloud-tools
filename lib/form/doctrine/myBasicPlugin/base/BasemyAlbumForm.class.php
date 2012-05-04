<?php

/**
 * myAlbum form base class.
 *
 * @method myAlbum getObject() Returns the current form's model object
 *
 * @package    testing
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasemyAlbumForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'title'             => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormInputText(),
      'type'              => new sfWidgetFormChoice(array('choices' => array('Image' => 'Image', 'Video' => 'Video', 'File' => 'File', 'Mixed' => 'Mixed'))),
      'deleteAllowed'     => new sfWidgetFormInputText(),
      'my_file_id'        => new sfWidgetFormInputText(),
      'object_class_name' => new sfWidgetFormInputText(),
      'object_id'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'             => new sfValidatorString(array('max_length' => 64)),
      'description'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'type'              => new sfValidatorChoice(array('choices' => array(0 => 'Image', 1 => 'Video', 2 => 'File', 3 => 'Mixed'), 'required' => false)),
      'deleteAllowed'     => new sfValidatorPass(),
      'my_file_id'        => new sfValidatorInteger(array('required' => false)),
      'object_class_name' => new sfValidatorString(array('max_length' => 128)),
      'object_id'         => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('my_album[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'myAlbum';
  }

}
