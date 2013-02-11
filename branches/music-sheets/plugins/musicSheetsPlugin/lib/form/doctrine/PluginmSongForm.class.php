<?php

/**
 * mSong form.
 *
 * @package    testing
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginmSongForm extends BasemSongForm
{
  public function setup()
  {
    parent::setup();
    
    $raw_choices = Doctrine::getTable("mGroup")->retrieveMGroupRawArray();
    $choices = array();
    foreach($raw_choices as $r_choice)
    {
        $choices[$r_choice["id"]] = $r_choice["name"];
    }
    //var_dump($choices);
    $this->widgetSchema['m_group_id'] = new sfWidgetFormChoiceAutocompleteComboBox(array('choices' => $choices));
    $choices[''] = true;
    $this->widgetSchema['m_group_original_id'] = new sfWidgetFormChoiceAutocompleteComboBox(array('choices' => $choices));
    $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
    //$this->validatorSchema['m_group_id']        = new sfValidatorString(array('max_length' => 20, 'required' => true));
    
    /*
    $this->widgetSchema['m_group_original_id'] = new sfWidgetFormInputAutocomplete(array('choices' => Doctrine::getTable("mGroup")->findAll()));
    $this->validatorSchema['m_group_original_id']        = new sfValidatorString(array('max_length' => 20, 'required' => false));
    */
  }
  
  public function save($con = null) {
    $tainted = $this->getTaintedValues();
    
    return parent::save($con);
  }

}
