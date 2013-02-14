<?php

/**
 * myCategoryTranslation form.
 *
 * @package    testing
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginmyCategoryTranslationForm extends BasemyCategoryTranslationForm
{
  public function setup()
  {
    parent::setup();
    unset($this['slug']);
  }
}
