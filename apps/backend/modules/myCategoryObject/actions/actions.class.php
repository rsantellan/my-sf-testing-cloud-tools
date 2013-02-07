<?php

/**
 * myCategoryObject actions.
 *
 * @package    testing
 * @subpackage myCategoryObject
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class myCategoryObjectActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
  }
  
  public function executeAddToObject(sfWebRequest $request)
  {
    $categoryId = $request->getPostParameter("categoryId");
    $objectClass = $request->getPostParameter("objectClass");
    $objectId = $request->getPostParameter("objectId");
    $myCategoryObject = new myCategoryObject();
    $myCategoryObject->setObjectId($objectId);
    $myCategoryObject->setObjectClassName($objectClass);
    $myCategoryObject->setMyCategoryId($categoryId);
    $myCategoryObject->save();
    
    die;
  }
}
