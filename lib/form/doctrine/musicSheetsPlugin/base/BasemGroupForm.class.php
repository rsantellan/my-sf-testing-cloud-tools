<?php

/**
 * mGroup form base class.
 *
 * @method mGroup getObject() Returns the current form's model object
 *
 * @package    testing
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasemGroupForm extends PluginmGroupForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('m_group[%s]');
  }

  public function getModelName()
  {
    return 'mGroup';
  }

}
