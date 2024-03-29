<?php

/**
 * PluginmyUploadedTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginmyUploadedTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PluginmyUploadedTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginmyUploaded');
    }
    
    public function selectMaxPriority($albumId)
    {
      $query = $this->createQuery("myUploaded")
                ->select("MAX(myUploaded.priority)")
                ->addWhere("myUploaded.my_album_id = ?", $albumId);
      $return = $query->fetchArray();
      if(isset($return[0]))
      {
        if(isset($return[0]["MAX"]))
        {
          $max = $return[0]["MAX"];
          if(!is_null($max))
          {
            return (int) $max;
          }
        }
      }
      return 0;
    }
    
    public function retrieveAlbumContent($albumId, $order = "DESC", $hydrationMode = Doctrine_Core::HYDRATE_RECORD)
    {
      $query = $this->createQuery("myUploaded")
              ->addWhere("myUploaded.my_album_id = ?", $albumId)
              ->orderBy("myUploaded.priority ". $order);
      
      $query->setHydrationMode($hydrationMode);
      return $query->execute();
    }
    
    public function updateOrfinalOfUploaded($uploadedId, $priority)
    {
      return Doctrine_Query::create()
              ->update('myUploaded myU')
              ->set('myU.priority', '?', $priority)
              ->where('myU.id = ?', $uploadedId)
              ->execute();
    }
}