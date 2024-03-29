<?php

/**
 * BasemyCategoryObject
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $object_id
 * @property integer $my_category_id
 * @property string $object_class_name
 * @property integer $priority
 * @property myCategory $myCategory
 * 
 * @method integer          getObjectId()          Returns the current record's "object_id" value
 * @method integer          getMyCategoryId()      Returns the current record's "my_category_id" value
 * @method string           getObjectClassName()   Returns the current record's "object_class_name" value
 * @method integer          getPriority()          Returns the current record's "priority" value
 * @method myCategory       getMyCategory()        Returns the current record's "myCategory" value
 * @method myCategoryObject setObjectId()          Sets the current record's "object_id" value
 * @method myCategoryObject setMyCategoryId()      Sets the current record's "my_category_id" value
 * @method myCategoryObject setObjectClassName()   Sets the current record's "object_class_name" value
 * @method myCategoryObject setPriority()          Sets the current record's "priority" value
 * @method myCategoryObject setMyCategory()        Sets the current record's "myCategory" value
 * 
 * @package    testing
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasemyCategoryObject extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('my_category_object');
        $this->hasColumn('object_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('my_category_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('object_class_name', 'string', 250, array(
             'type' => 'string',
             'primary' => true,
             'length' => 250,
             ));
        $this->hasColumn('priority', 'integer', 2, array(
             'type' => 'integer',
             'default' => 0,
             'length' => 2,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('myCategory', array(
             'local' => 'my_category_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}