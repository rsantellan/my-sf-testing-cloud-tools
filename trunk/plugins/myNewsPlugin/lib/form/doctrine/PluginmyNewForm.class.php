<?php

/**
 * PluginmyNew form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginmyNewForm extends BasemyNewForm
{
  public function setup() {
    parent::setup();
    unset($this['created_at'], $this['updated_at'], $this['views_count']);
    
    $this->widgetSchema["copete"] = new myWidgetFormTextareaCleditor();
    $this->widgetSchema["body"] = new myWidgetFormTextareaCleditor();
    $this->widgetSchema["publish"] = new sfWidgetFormInputDatepicker();
    //new sfWidgetFormTextareaTinyMCE();
  }
}
