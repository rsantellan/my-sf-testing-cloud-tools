<?php

/**
 * myCategory filter form base class.
 *
 * @package    testing
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasemyCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'label'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'object_class_name'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'my_category_parent_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('myCategory'), 'add_empty' => true)),
      'priority'              => new sfWidgetFormFilterInput(),
      'can_edit_or_delete'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'label'                 => new sfValidatorPass(array('required' => false)),
      'object_class_name'     => new sfValidatorPass(array('required' => false)),
      'my_category_parent_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('myCategory'), 'column' => 'id')),
      'priority'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'can_edit_or_delete'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('my_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'myCategory';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'label'                 => 'Text',
      'object_class_name'     => 'Text',
      'my_category_parent_id' => 'ForeignKey',
      'priority'              => 'Number',
      'can_edit_or_delete'    => 'Boolean',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
