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
    
    $this->my_categorys = Doctrine_Core::getTable('myCategory')
      ->createQuery('a')
      ->execute();
  }

  public function executeRetrieveCategoriesOfClass(sfWebRequest $request)
  {
    $objectClass = $request->getPostParameter("objectClass", null);
    $this->forward404Unless($objectClass != null);
    $this->results = Doctrine::getTable("myCategory")->retrieveAllTreeOfObjectClass($objectClass);
    $partial = $this->getPartial("categoryTree", array('results' => $this->results, "class" => "menu"));
    
    echo myBasicHandler::JsonResponse(true, array('body' => $partial));
    die;
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

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($my_category = Doctrine_Core::getTable('myCategory')->find(array($request->getParameter('id'))), sprintf('Object my_category does not exist (%s).', $request->getParameter('id')));
    $this->form = new myCategoryForm($my_category);
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
