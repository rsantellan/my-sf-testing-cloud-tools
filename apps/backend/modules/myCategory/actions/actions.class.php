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
    $this->forward404Unless($objectClass != null);
    $this->results = Doctrine::getTable("myCategory")->retrieveAllTreeOfObjectClass($objectClass);
    $partial = $this->getPartial("categoryTree", array('results' => $this->results, "class" => "menu"));
    
    return $this->renderText(myBasicHandler::JsonResponse(true, array('body' => $partial)));
    die;
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
  
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new myCategoryForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new myCategoryForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($my_category = Doctrine_Core::getTable('myCategory')->find(array($request->getParameter('id'))), sprintf('Object my_category does not exist (%s).', $request->getParameter('id')));
    $this->form = new myCategoryForm($my_category);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($my_category = Doctrine_Core::getTable('myCategory')->find(array($request->getParameter('id'))), sprintf('Object my_category does not exist (%s).', $request->getParameter('id')));
    $my_category->delete();

    $this->redirect('myCategory/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $my_category = $form->save();

      $this->redirect('myCategory/edit?id='.$my_category->getId());
    }
  }
}
