<?php
 
class myMediaContentBehavior extends Doctrine_Template
{
    public function setTableDefinition()
    {
        $this->addListener(new myMediaContentBehaviorListener());
    }

/*    
    public function getUrl($options = array('width' => 46,'height' => 46))
    {
        //solucion temporal hasta que se generen avatares para los videos
        return $this->getInvoker()->getObjectUrl($options);
    }
*/

    /**
     * Devuelve el  objeto concreto
     * uso: $mdMediaContent = $object->retreiveMdMediaContent();
     * @return <mdMediaContent>
     */
    public function retrieveMyMediaContent()
    {
        return NULL; // Doctrine::getTable('mdMediaContent')->retrieveByObject($this->getInvoker());
    }

    public function savePriority($value)
    {
        $this->getInvoker()->priority = $value;
    }

    public function retrievePriority()
    {
        return $this->getInvoker()->priority;
    }

}

