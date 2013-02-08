<?php

/**
 * BasemGroup
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property Doctrine_Collection $mSong
 * 
 * @method integer             getId()          Returns the current record's "id" value
 * @method string              getName()        Returns the current record's "name" value
 * @method string              getDescription() Returns the current record's "description" value
 * @method Doctrine_Collection getMSong()       Returns the current record's "mSong" collection
 * @method mGroup              setId()          Sets the current record's "id" value
 * @method mGroup              setName()        Sets the current record's "name" value
 * @method mGroup              setDescription() Sets the current record's "description" value
 * @method mGroup              setMSong()       Sets the current record's "mSong" collection
 * 
 * @package    testing
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasemGroup extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('musicgroup');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'string', 500, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 500,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('mSong', array(
             'local' => 'id',
             'foreign' => 'm_group_id'));
    }
}