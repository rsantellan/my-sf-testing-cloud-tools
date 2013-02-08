<?php

/**
 * BasemyAlbum
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property enum $type
 * @property bool $deleteAllowed
 * @property integer $my_file_id
 * @property string $object_class_name
 * @property integer $object_id
 * @property string $allowed_types
 * @property Doctrine_Collection $myUploaded
 * 
 * @method integer             getId()                Returns the current record's "id" value
 * @method string              getTitle()             Returns the current record's "title" value
 * @method string              getDescription()       Returns the current record's "description" value
 * @method enum                getType()              Returns the current record's "type" value
 * @method bool                getDeleteAllowed()     Returns the current record's "deleteAllowed" value
 * @method integer             getMyFileId()          Returns the current record's "my_file_id" value
 * @method string              getObjectClassName()   Returns the current record's "object_class_name" value
 * @method integer             getObjectId()          Returns the current record's "object_id" value
 * @method string              getAllowedTypes()      Returns the current record's "allowed_types" value
 * @method Doctrine_Collection getMyUploaded()        Returns the current record's "myUploaded" collection
 * @method myAlbum             setId()                Sets the current record's "id" value
 * @method myAlbum             setTitle()             Sets the current record's "title" value
 * @method myAlbum             setDescription()       Sets the current record's "description" value
 * @method myAlbum             setType()              Sets the current record's "type" value
 * @method myAlbum             setDeleteAllowed()     Sets the current record's "deleteAllowed" value
 * @method myAlbum             setMyFileId()          Sets the current record's "my_file_id" value
 * @method myAlbum             setObjectClassName()   Sets the current record's "object_class_name" value
 * @method myAlbum             setObjectId()          Sets the current record's "object_id" value
 * @method myAlbum             setAllowedTypes()      Sets the current record's "allowed_types" value
 * @method myAlbum             setMyUploaded()        Sets the current record's "myUploaded" collection
 * 
 * @package    testing
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasemyAlbum extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('my_album');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('title', 'string', 64, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 64,
             ));
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'Image',
              1 => 'Video',
              2 => 'File',
              3 => 'Mixed',
             ),
             'default' => 'Mixed',
             ));
        $this->hasColumn('deleteAllowed', 'bool', null, array(
             'type' => 'bool',
             'notnull' => true,
             ));
        $this->hasColumn('my_file_id', 'integer', 4, array(
             'type' => 'integer',
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
        $this->hasColumn('allowed_types', 'string', 128, array(
             'type' => 'string',
             'length' => 128,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('myUploaded', array(
             'local' => 'id',
             'foreign' => 'my_album_id'));
    }
}