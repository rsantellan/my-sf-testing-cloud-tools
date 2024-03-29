<?php

/**
 * myCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    testing
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginmyCategory extends BasemyCategory
{
  
  public function save(Doctrine_Connection $conn = null)
  {
    if($this->getId() == 0)
    {
      $aux = Doctrine::getTable("myCategory")->retrieveLastPriorityNumber($this->getObjectClassName(), $this->getMyCategoryParentId());
      $this->setPriority( ((int) $aux["myC_prior"]) + 1);
    }
    
    return parent::save($conn);
  }
  
  public function recalculatePriorityAndSave()
  {
    $aux = Doctrine::getTable("myCategory")->retrieveLastPriorityNumber($this->getObjectClassName(), $this->getMyCategoryParentId());
    $this->setPriority( ((int) $aux["myC_prior"]) + 1);
    return $this->save();
  }

}
