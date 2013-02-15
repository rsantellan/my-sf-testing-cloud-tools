<?php

/**
 * mGroupTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginmGroupTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object mGroupTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('mGroup');
    }
    
    public function retrieveMGroupRawArray()
    {
      $conn = Doctrine_Manager::getInstance()->getCurrentConnection(); 
      $sql = "select id, name from musicgroup order by name asc";
      $r = $conn->fetchAssoc($sql, array());
      return $r;
    }
}