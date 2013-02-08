<?php

/**
 * myCategory form base class.
 *
 * @method myCategory getObject() Returns the current form's model object
 *
 * @package    testing
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasemyCategoryForm extends PluginmyCategoryForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('my_category[%s]');
  }

  public function getModelName()
  {
    return 'myCategory';
  }

}
