<?php
class myCategoryObjectComponents extends sfComponents
{
    public function executeCategories(sfWebRequest $request)
    {
      $this->categories = Doctrine::getTable("myCategory")->retrieveAllTreeOfObjectClass($this->objectClass);
      $this->used_categories_id = Doctrine::getTable("myCategoryObject")->getObjectCategoriesId($this->objectId, $this->objectClass);
      
      if(count($this->used_categories_id) == 0)
      {
        $this->used_categories = array();
      }
      else
      {
        $this->used_categories = Doctrine::getTable("myCategory")->retrieveAllCategoriesOfIds($this->used_categories_id);
      }
    }
}
