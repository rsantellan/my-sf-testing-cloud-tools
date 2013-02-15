<?php

/**
 * myCategory form base class.
 *
 * @method myCategory getObject() Returns the current form's model object
 *
 * @package    testing
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasemyCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'label'                 => new sfWidgetFormInputText(),
      'object_class_name'     => new sfWidgetFormInputText(),
      'my_category_parent_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('myCategory'), 'add_empty' => true)),
      'priority'              => new sfWidgetFormInputText(),
      'can_edit_or_delete'    => new sfWidgetFormInputCheckbox(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'label'                 => new sfValidatorString(array('max_length' => 100)),
      'object_class_name'     => new sfValidatorString(array('max_length' => 100)),
      'my_category_parent_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('myCategory'), 'required' => false)),
      'priority'              => new sfValidatorInteger(array('required' => false)),
      'can_edit_or_delete'    => new sfValidatorBoolean(array('required' => false)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'myCategory', 'column' => array('label')))
    );

    $this->widgetSchema->setNameFormat('my_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'myCategory';
  }

}
