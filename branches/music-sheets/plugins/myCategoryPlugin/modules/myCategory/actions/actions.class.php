<?php

/**
 * myCategory actions.
 *
 * @package    testing
 * @subpackage myCategory
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class myCategoryActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->my_categories_classes = Doctrine::getTable("myCategory")->retrieveCategoriesObjectClasses();
    
  }

  public function executeRetrieveCategoriesOfClass(sfWebRequest $request)
  {
    $objectClass = $request->getPostParameter("objectClass", null);
    $this->forward404Unless($objectClass);
    $this->results = Doctrine::getTable("myCategory")->retrieveAllTreeOfObjectClass($objectClass);
    $partial = $this->getPartial("categoryTree", array('results' => $this->results, "class" => "menu"));
    
    return $this->renderText(myBasicHandler::JsonResponse(true, array('body' => $partial)));
    die;
  }
  
  public function executeAdd(sfWebRequest $request)
  {
    $objectClass = $request->getPostParameter("objectClass", null);
    $this->forward404Unless($objectClass);
    $parentId = $request->getPostParameter("parentId", null);
    $this->forward404Unless($parentId);
    $my_category = new myCategory();
    $my_category->setObjectClassName($objectClass);
    if(is_null($parentId) || $parentId == "null")
    {
      $parentId = null;
    }
    $my_category->setMyCategoryParentId($parentId);
    $this->form = new myCategoryForm($my_category);
    $partial = $this->getPartial('form', array('form' => $this->form));
    return $this->renderText(myBasicHandler::JsonResponse(true, array('body' => $partial)));
  }
 
  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($my_category = Doctrine_Core::getTable('myCategory')->find(array($request->getParameter('id'))), sprintf('Object my_category does not exist (%s).', $request->getParameter('id')));
    $this->form = new myCategoryForm($my_category);
    $partial = $this->getPartial('form', array('form' => $this->form));
    return $this->renderText(myBasicHandler::JsonResponse(true, array('body' => $partial)));
  }
  
  public function executeSave(sfWebRequest $request)
  {
      $parameters = $request->getPostParameters();
      
      $auxForm = new myCategoryForm();
      $parameters = $request->getParameter($auxForm->getName());
      $id = $parameters["id"];
      $isNew = true;
      if($id)
      {
        $myCategoria = Doctrine::getTable('myCategory')->find($id);
        $this->forward404Unless($myCategoria);
        $form = new myCategoryForm($myCategoria); 
        $isNew = false;
      }
      else
      {
        
        $form = new myCategoryForm(); 
      }
      $form->bind($parameters);
      if ($form->isValid())
      {
        $myCategoria = $form->save();
        $form = new myCategoryForm($myCategoria);
        $body = $this->getPartial('form', array('form'=>$form));
        return $this->renderText(myBasicHandler::JsonResponse(true, array('body' => $body)));
        //return $this->renderText(mdBasicFunction::basic_json_response(true, array('isnew'=>$isNew, 'id'=>$donante->getId(), 'identificador'=>$donante->getIdentificador(), 'body' => $body)));
      }
      else
      {
        $body = $this->getPartial('form', array('form'=>$form));
        return $this->renderText(myBasicHandler::JsonResponse(false, array('body' => $body)));
        //return $this->renderText(mdBasicFunction::basic_json_response(false, array('body' => $body)));
      }
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($my_category = Doctrine_Core::getTable('myCategory')->find(array($request->getParameter('id'))), sprintf('Object my_category does not exist (%s).', $request->getParameter('id')));
    try
    {
      $my_category->delete();
      return $this->renderText(myBasicHandler::JsonResponse(true, array()));
    }
    catch(Exception $e)
    {
      return $this->renderText(myBasicHandler::JsonResponse(false, array('error_code' => $e->getCode(), 'error_message' => $e->getMessage())));
    }
  }
  
  public function executeMoveUp(sfWebRequest $request)
  {
    $this->forward404Unless($my_category = Doctrine_Core::getTable('myCategory')->find(array($request->getParameter('id'))), sprintf('Object my_category does not exist (%s).', $request->getParameter('id')));
    if($my_category->getMyCategory())
    {
      $parentId = $my_category->getMyCategory()->getMyCategoryParentId();
      if(empty($parentId) || is_null($parentId))
      {
        Doctrine::getTable("myCategory")->updateToNullParent($my_category->getObjectClassName(), $my_category->getId());
      }
      else
      {
        $my_category->setMyCategoryParentId($parentId);
        $my_category->save();
      }
    }
    return $this->renderText(myBasicHandler::JsonResponse(true, array()));
  }
  
  public function executeBringSiblings(sfWebRequest $request)
  {
    $this->forward404Unless($my_category = Doctrine_Core::getTable('myCategory')->find(array($request->getParameter('id'))), sprintf('Object my_category does not exist (%s).', $request->getParameter('id')));
    $categories = Doctrine::getTable("myCategory")->retrieveSiblings($my_category->getMyCategoryParentId(), $my_category->getObjectClassName(), $my_category->getId());
    $body = $this->getPartial('siblings', array('categories' => $categories, 'categoryId' => $my_category->getId()));
    return $this->renderText(myBasicHandler::JsonResponse(true, array('body' => $body)));
  }
  
  public function executeMoveDown(sfWebRequest $request)
  {
    $parameters = $request->getPostParameters();
    $this->forward404Unless($my_category = Doctrine_Core::getTable('myCategory')->find(array($parameters["categoryId"])), sprintf('Object my_category does not exist (%s).', $request->getParameter('id')));
    //var_dump($parameters);
    $my_category->setMyCategoryParentId($parameters["category_parent_id"]);
    $my_category->recalculatePriorityAndSave();
    return $this->renderText(myBasicHandler::JsonResponse(true, array()));
    //die;
  }
  
  public function executeMovePosition(sfWebRequest $request)
  {
    $parameters = $request->getPostParameters();
    $delta = (int) $parameters["delta"];
    
    $this->forward404Unless($my_category = Doctrine_Core::getTable('myCategory')->find(array($request->getParameter('categoryId'))), sprintf('Object my_category does not exist (%s).', $request->getParameter('id')));
    $categories = Doctrine::getTable("myCategory")->retrieveSiblings($my_category->getMyCategoryParentId(), $my_category->getObjectClassName(), $my_category->getId(), false);
    $index = 0;
    $category_previously = null;
    $is_finished = false;
    $finish_on_next = false;
    while($index < count($categories) && !$is_finished)
    {
      $category = $categories->get($index);
      if($finish_on_next)
      {
        $aux_priority = $category->getPriority();
        $category->setPriority($category_previously->getPriority());
        $category_previously->setPriority($aux_priority);
        $category->save();
        $category_previously->save();
        $is_finished = true;
        //var_dump('saving');
      }
      if($category->getId() == $my_category->getId())
      {
        if($delta < 0)
        {
          if(!is_null($category_previously))
          {
            $aux_priority = $category->getPriority();
            $category->setPriority($category_previously->getPriority());
            $category_previously->setPriority($aux_priority);
            $category->save();
            $category_previously->save();
            //var_dump('saving');
          }
          $is_finished = true;
        }
        else
        {
          $finish_on_next = true;
        }
      }
      
      $category_previously = $category;
      $index++;
    }
    return $this->renderText(myBasicHandler::JsonResponse(true, array()));
  }
}
