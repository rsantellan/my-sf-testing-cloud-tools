<?php

/**
 * PluginmyUploaded form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginmyUploadedForm extends BasemyUploadedForm
{
  public function setup()
  {
    parent::setup();
    unset($this['created_at'], $this['updated_at'], $this['priority'], $this['filetype'], $this['path'], $this['filename'], $this['my_album_id'] ) ;
    
    $this->widgetSchema['description'] = new sfWidgetFormTextarea();
    $this->validatorSchema['description'] = new sfValidatorString(array('max_length' => 64));
  }
}
