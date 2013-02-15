<?php

/**
 * BasemyMediaContent
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $object_class_name
 * @property integer $object_id
 * @property integer $priority
 * @property integer $my_album_id
 * @property myAlbum $myAlbum
 * 
 * @method integer        getId()                Returns the current record's "id" value
 * @method string         getObjectClassName()   Returns the current record's "object_class_name" value
 * @method integer        getObjectId()          Returns the current record's "object_id" value
 * @method integer        getPriority()          Returns the current record's "priority" value
 * @method integer        getMyAlbumId()         Returns the current record's "my_album_id" value
 * @method myAlbum        getMyAlbum()           Returns the current record's "myAlbum" value
 * @method myMediaContent setId()                Sets the current record's "id" value
 * @method myMediaContent setObjectClassName()   Sets the current record's "object_class_name" value
 * @method myMediaContent setObjectId()          Sets the current record's "object_id" value
 * @method myMediaContent setPriority()          Sets the current record's "priority" value
 * @method myMediaContent setMyAlbumId()         Sets the current record's "my_album_id" value
 * @method myMediaContent setMyAlbum()           Sets the current record's "myAlbum" value
 * 
 * @package    testing
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasemyMediaContent extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('my_media_content');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('object_class_name', 'string', 128, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 128,
             ));
        $this->hasColumn('object_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('priority', 'integer', 4, array(
             'type' => 'integer',
             'default' => 0,
             'length' => 4,
             ));
        $this->hasColumn('my_album_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));


        $this->index('md_media_content_index', array(
             'fields' => 
             array(
              0 => 'object_class_name',
              1 => 'object_id',
             ),
             'type' => 'unique',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('myAlbum', array(
             'local' => 'my_album_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}