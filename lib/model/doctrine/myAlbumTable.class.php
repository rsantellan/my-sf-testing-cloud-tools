<?php

/**
 * myAlbumTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class myAlbumTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object myAlbumTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('myAlbum');
    }
    
    public function retrieveAllAlbumsOfObject($objectId, $objectClass, $hydrationMode = Doctrine_Core::HYDRATE_RECORD)
    {
      $query = $this->createQuery("myAlbum")
          ->addWhere("myAlbum.object_id = ?", $objectId)
          ->addWhere("myAlbum.object_class_name = ?", $objectClass);
      $query->setHydrationMode($hydrationMode);
      return $query->execute();
    }
    
    public function retrieveAlbumOfObject($objectId, $objectClass, $title, $hydrationMode = Doctrine_Core::HYDRATE_RECORD)
    {
      $query = $this->createQuery("myAlbum")
          ->addWhere("myAlbum.object_id = ?", $objectId)
          ->addWhere("myAlbum.object_class_name = ?", $objectClass)
          ->addWhere("myAlbum.title = ?", $title);
      $query->setHydrationMode($hydrationMode);
      return $query->fetchOne();
    }
}