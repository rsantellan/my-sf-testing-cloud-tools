<?php

/**
 * PluginsfGuardUser form.
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: PluginsfGuardUserForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
abstract class PluginsfGuardUserForm extends BasesfGuardUserForm
{
  public function setup()
  {
	parent::setup();
      	  unset ( 
					$this ['algorithm'], 
					$this ['salt'], 
					$this ['last_login'], 
					$this ['created_at'], 
					$this ['updated_at'] 
				);
   $this->validatorSchema['email_address'] = new sfValidatorEmail();             
   if(!$this->isNew())
   {
     unset($this['password']);
   }
   else
   {
      $this->widgetSchema ['password'] = new sfWidgetFormInputPassword ( );
      $this->validatorSchema ['password']->setOption ( 'required', true );	
      $this->widgetSchema ['password_confirmation'] = new sfWidgetFormInputPassword ( );
      $this->validatorSchema ['password_confirmation'] = clone $this->validatorSchema ['password'];
      $this->widgetSchema->moveField ( 'password_confirmation', 'after', 'password' );
      $this->mergePostValidator ( new sfValidatorSchemaCompare ( 'password', sfValidatorSchemaCompare::EQUAL, 'password_confirmation', array (), array ('invalid' => 'The two passwords must be the same.' ) ) );           
   }
          
    

  }
}
