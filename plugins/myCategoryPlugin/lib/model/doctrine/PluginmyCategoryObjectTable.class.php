<?php

/**
 * myCategoryObjectTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginmyCategoryObjectTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object myCategoryObjectTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('myCategoryObject');
    }
    
    public function getObjectCategoriesId($object_id, $object_class)
    {
      $sql = "select my_category_id from my_category_object where object_id = ? and object_class_name = ?";
      $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
      //$conn->fetchA
      $result = $conn->fetchAll($sql, array($object_id, $object_class));
      $return = array();
      foreach($result as $key => $val)
      {
        $return[] = $val["my_category_id"];
      }
      return $return;
    }
    
    public function retrieveByPk($object_id, $object_class, $category_id)
    {
      $q = $this->createQuery("myCO")
              ->addWhere("myCO.object_id = ?", $object_id)
              ->addWhere("myCO.my_category_id = ?", $category_id)
              ->addWhere("myCO.object_class_name = ?", $object_class);
      return $q->fetchOne();
    }
}