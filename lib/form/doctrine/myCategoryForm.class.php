<?php

/**
 * myCategory form.
 *
 * @package    testing
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class myCategoryForm extends BasemyCategoryForm
{
  public function configure()
  {
    unset ($this ['created_at'], $this ['updated_at'], $this['priority'], $this['label']);
    
    $this->widgetSchema['object_class_name'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['my_category_parent_id'] = new sfWidgetFormInputHidden();
    
    $culture = $this->getOption('culture');
	if(is_null($culture))
	{
	  try{
		$culture = sfContext::getInstance()->getUser()->getCulture();
	  }catch(Exception $e)
	  {
		$culture = 'en';
	  }
	}
	$this->embedI18n(array($culture));
  }
  
  public function save($con = null) {
    
    $myCategory = parent::save($con);
    $myCategory->setSlug(myBasicHandler::slugify($myCategory->getName()));
    $myCategory->setLabel(myBasicHandler::slugify($myCategory->getName()));
    
    try
    {
      $myCategory->save();
    }
    catch(Exception $e)
    {
      $myCategory->setSlug(myBasicHandler::slugify($myCategory->getName().time()));
      
      $myCategory->setLabel(myBasicHandler::slugify($myCategory->getName().time()));
      $myCategory->save();
    }
    return $myCategory;
  }

}
