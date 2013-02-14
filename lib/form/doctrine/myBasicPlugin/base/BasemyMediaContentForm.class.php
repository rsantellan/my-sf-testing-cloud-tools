<?php

/**
 * myMediaContent form base class.
 *
 * @method myMediaContent getObject() Returns the current form's model object
 *
 * @package    testing
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasemyMediaContentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'object_class_name' => new sfWidgetFormInputText(),
      'object_id'         => new sfWidgetFormInputText(),
      'priority'          => new sfWidgetFormInputText(),
      'my_album_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('myAlbum'), 'add_empty' => true)),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'object_class_name' => new sfValidatorString(array('max_length' => 128)),
      'object_id'         => new sfValidatorInteger(),
      'priority'          => new sfValidatorInteger(array('required' => false)),
      'my_album_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('myAlbum'), 'required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'myMediaContent', 'column' => array('object_class_name', 'object_id')))
    );

    $this->widgetSchema->setNameFormat('my_media_content[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'myMediaContent';
  }

}
