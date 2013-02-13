<?php

/*
 */

/**
 * Description of myAlbumHandler
 *
 * @author Rodrigo Santellan <rodrigo.santellan at inswitch.us>
 */
class myAlbumHandler {
  
  const VIDEOS    = 'Video';
  
  const ONLINEVIDEOS     = "onlinevideos";

  const IMAGES    = 'Image';

  const FILES     = 'File';

  const MIXED     = 'Mixed';

  const YOUTUBEVIDEOS = "youtube";

  const VIMEO     = "vimeo";
  
  public static function retrieveAlbumsOfObject($objectId, $objectClass, $hydrationMode = Doctrine_Core::HYDRATE_RECORD)
  {
    return Doctrine::getTable("myAlbum")->retrieveAllAlbumsOfObject($objectId, $objectClass, $hydrationMode);
  }
  
  public static function createAlbum($objectId, $objectClass, $title = "default", $description = "default", $type = self::MIXED, $allowed_types = null)
  {
    $album = self::retrieveAlbum($objectId, $objectClass, $title);
    if(!$album)
    {
      $album = new myAlbum();
      $album->setTitle($title);
      $album->setObjectClassName($objectClass);
      $album->setObjectId($objectId);
      $album->setType($type);
      $album->setDeleteAllowed(true);
      $album->setDescription($description);
	  $album->setAllowedTypes($allowed_types);
      $album->save();
    }
    return $album;
  }
  
  public static function retrieveAlbum($objectId, $objectClass, $title, $hydrationMode = Doctrine_Core::HYDRATE_RECORD)
  {
    return Doctrine::getTable("myAlbum")->retrieveAlbumOfObject($objectId, $objectClass, $title, $hydrationMode);
  }
  
  public static function saveUploadedFileToAlbum($albumId, $options = array(), $user_id = null)
  {
    
    $uploader = new myUploaded();
    $uploader->setMyAlbumId($albumId);
    $uploader->setName($options["name"]);
    $uploader->setFilename($options["filename"]);
    $uploader->setDescription($options["description"]);
    $uploader->setPath($options["path"]);
    $uploader->setFiletype($options["type"]);
    $uploader->setPriority(self::retrieveLastAlbumPriority($albumId));
    $uploader->setUserId($user_id);
    $uploader->save();
    return $uploader;
  }
  
  public static function retrieveLastAlbumPriority($albumId)
  {
    return (Doctrine::getTable("myUploaded")->selectMaxPriority($albumId) + 1);
  }
  
  public static function retrieveAlbumContent($albumId, $order = "DESC", $hydrationMode = Doctrine_Core::HYDRATE_RECORD)
  {
    $contents_meta = Doctrine::getTable("myMediaContent")->retrieveByAlbum($albumId, $order, $hydrationMode);
    $uploaded_data = Doctrine::getTable("myUploaded")->retrieveAlbumContent($albumId, $order, $hydrationMode);
    $videos_data = Doctrine::getTable("myAlbumVideo")->retrieveAlbumContent($albumId, $order, $hydrationMode);
    
    $return = array();
    foreach($contents_meta as $content)
    {
      switch ($content->getObjectClassName()) {
        case "myAlbumVideo":
            $aux = self::retrieveWithIdFromArray($videos_data, $content->getObjectId());
            if(!is_null($aux))
            {
              $return[$content->getObjectId()] = $aux;
            }
          break;
        case "myUploaded":
            $aux = self::retrieveWithIdFromArray($uploaded_data, $content->getObjectId());
            if(!is_null($aux))
            {
              $return[$content->getObjectId()] = $aux;
            }
          break;
        default:
          break;
      }
    }
    return $return;
  }
  
  private static function retrieveWithIdFromArray($data, $id)
  {
    foreach($data as $obj)
    {
      if($obj->getId() == $id)
      {
        return $obj;
      }
    }
    return null;
  }
  
  public static function updateOrfinalOfUploaded($uploadedId, $priority)
  {
    return Doctrine::getTable("myUploaded")->updateOrfinalOfUploaded($uploadedId, $priority);
  }
  
  public static function deleteAllAlbumsOfObject($objectId, $objectClass)
  {
    $albums = self::retrieveAlbumsOfObject($objectId, $objectClass);
    foreach($albums as $album)
    {
      $album->delete();
    }
  }
}


