<?php

/**
 * myNew form base class.
 *
 * @method myNew getObject() Returns the current form's model object
 *
 * @package    testing
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasemyNewForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'title'       => new sfWidgetFormInputText(),
      'copete'      => new sfWidgetFormInputText(),
      'body'        => new sfWidgetFormInputText(),
      'source'      => new sfWidgetFormInputText(),
      'publish'     => new sfWidgetFormDateTime(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'views_count' => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 128)),
      'copete'      => new sfValidatorPass(array('required' => false)),
      'body'        => new sfValidatorPass(),
      'source'      => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'publish'     => new sfValidatorDateTime(),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
      'views_count' => new sfValidatorInteger(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('my_new[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'myNew';
  }

}
