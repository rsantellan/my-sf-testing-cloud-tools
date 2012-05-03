<?php

/**
 * myDefault actions.
 *
 * @package    testing
 * @subpackage myDefault
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class myDefaultActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
  }
  
  public function executeOpcionesBasicas(sfWebRequest $request)
  {
    
  }
  
  public function executeSymfonyClearCache(sfWebRequest $request)
  {

      chdir(sfConfig::get('sf_root_dir')); // Trick plugin into thinking you are in a project directory

      $task = new sfCacheClearTask($this->dispatcher, new sfFormatter());
      $task->run(array(), array('app' => "backend"));
      $task->run(array(), array('app' => "frontend"));
      
      return $this->renderText(myBasicHandler::JsonResponse(true, array()));
  }
}
