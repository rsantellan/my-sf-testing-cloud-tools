<?php

/**
 * PluginmyAlbumVideo form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginmyAlbumVideoForm extends BasemyAlbumVideoForm
{
  public function setUp() {
    parent::setUp();
    
    $this->widgetSchema['my_album_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
    $this->validatorSchema["src"] = new sfValidatorUrl(array('max_length' => 255, 'required' => true));
    unset($this['created_at'], $this['updated_at'], $this['priority'], $this['description'], $this['code']);
  }
}
