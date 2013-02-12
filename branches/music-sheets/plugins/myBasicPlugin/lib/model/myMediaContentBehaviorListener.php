<?php
 
class myMediaContentBehaviorListener extends Doctrine_Record_Listener
{
    /**
     * Guarda el mdMediaContent referenciando a el objeto recien creado
     * @param Doctrine_Event $event
     */
    public function postSave(Doctrine_Event $event)
    {
        
        $object = $event->getInvoker();
        $myMediaContent = Doctrine::getTable('myMediaContent')->retrieveByObjectClassAndId($object->getObjectClass(), $object->getId());
        if(!$myMediaContent)
        {
            $myMediaContent = new myMediaContent();
            $myMediaContent->setObjectClassName(get_class($object));
            $myMediaContent->setObjectId($object->getId());
            $myMediaContent->setMyAlbumId($object->getMyAlbumId());
            $myMediaContent->save();
        }
    }

    /**
     * Elimina mdMediaContent que referenciaba al objeto y ademas elimina al
     * contenido de todos los albums en los que estaba
     * @param Doctrine_Event $event
     */
    public function preDelete(Doctrine_Event $event)
    {
        $object = $event->getInvoker();
        $myMediaContent = Doctrine::getTable('myMediaContent')->retrieveByObjectClassAndId($object->getObjectClass(), $object->getId());
        if($myMediaContent)
        {
          $myMediaContent->delete();
        }
    }

}

