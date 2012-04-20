<?php

/**
 * myTest form.
 *
 * @package    testing
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class myTestForm extends BasemyTestForm
{
  public function configure()
  {
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
	//var_dump($culture);
	$this->embedI18n(array($culture));
	unset (  
			  $this ['created_at'], 
			  $this ['updated_at'] 
		  );
	
  }
}
