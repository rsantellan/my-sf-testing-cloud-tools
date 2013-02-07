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
    try {
      $myCategoryObject->save();
      return $this->renderText(myBasicHandler::JsonResponse(true, array()));
    }catch(Exception $e){
      return $this->renderText(myBasicHandler::JsonResponse(false, array()));
    }
    
    
    die;
  }
  
  public function executeRemoveOfObject(sfWebRequest $request)
  {
    $categoryId = $request->getPostParameter("categoryId");
    $objectClass = $request->getPostParameter("objectClass");
    $objectId = $request->getPostParameter("objectId");
    $myCategoryObject = Doctrine::getTable("myCategoryObject")->retrieveByPk($objectId, $objectClass, $categoryId);
    $myCategoryObject->delete();
    return $this->renderText(myBasicHandler::JsonResponse(true, array()));
    die;
  }
  
  public function executeRefreshObjectCategory(sfWebRequest $request)
  {
    $objectClass = $request->getParameter("objectClass");
    $objectId = $request->getParameter("objectId");
    $categories = Doctrine::getTable("myCategory")->retrieveAllTreeOfObjectClass($objectClass);
    $used_categories_id = Doctrine::getTable("myCategoryObject")->getObjectCategoriesId($objectId, $objectClass);

    $used_categories = Doctrine::getTable("myCategory")->retrieveAllCategoriesOfIds($used_categories_id);
    
    if(count($used_categories_id) == 0)
    {
      $used_categories = array();
    }
    else
    {
      $used_categories = Doctrine::getTable("myCategory")->retrieveAllCategoriesOfIds($used_categories_id);
    }
    $body = $this->getPartial("myCategoryObject/categoriesView", array("objectId" => $objectId, "objectClass" => $objectClass, "used_categories" => $used_categories, "used_categories_id" => $used_categories_id, "categories" => $categories));
    
    return $this->renderText(myBasicHandler::JsonResponse(true, array('body' => $body)));
  }
}
