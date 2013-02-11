<?php

/**
 * BasemyUploaded
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $my_album_id
 * @property string $name
 * @property string $filename
 * @property string $description
 * @property string $path
 * @property string $filetype
 * @property integer $priority
 * @property integer $user_id
 * @property myAlbum $myAlbum
 * @property sfGuardUser $User
 * 
 * @method integer     getId()          Returns the current record's "id" value
 * @method integer     getMyAlbumId()   Returns the current record's "my_album_id" value
 * @method string      getName()        Returns the current record's "name" value
 * @method string      getFilename()    Returns the current record's "filename" value
 * @method string      getDescription() Returns the current record's "description" value
 * @method string      getPath()        Returns the current record's "path" value
 * @method string      getFiletype()    Returns the current record's "filetype" value
 * @method integer     getPriority()    Returns the current record's "priority" value
 * @method integer     getUserId()      Returns the current record's "user_id" value
 * @method myAlbum     getMyAlbum()     Returns the current record's "myAlbum" value
 * @method sfGuardUser getUser()        Returns the current record's "User" value
 * @method myUploaded  setId()          Sets the current record's "id" value
 * @method myUploaded  setMyAlbumId()   Sets the current record's "my_album_id" value
 * @method myUploaded  setName()        Sets the current record's "name" value
 * @method myUploaded  setFilename()    Sets the current record's "filename" value
 * @method myUploaded  setDescription() Sets the current record's "description" value
 * @method myUploaded  setPath()        Sets the current record's "path" value
 * @method myUploaded  setFiletype()    Sets the current record's "filetype" value
 * @method myUploaded  setPriority()    Sets the current record's "priority" value
 * @method myUploaded  setUserId()      Sets the current record's "user_id" value
 * @method myUploaded  setMyAlbum()     Sets the current record's "myAlbum" value
 * @method myUploaded  setUser()        Sets the current record's "User" value
 * 
 * @package    testing
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasemyUploaded extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('my_uploaded');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('my_album_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 64, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 64,
             ));
        $this->hasColumn('filename', 'string', 64, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 64,
             ));
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('path', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('filetype', 'string', 64, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 64,
             ));
        $this->hasColumn('priority', 'integer', 4, array(
             'type' => 'integer',
             'default' => 0,
             'length' => 4,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('myAlbum', array(
             'local' => 'my_album_id',
             'foreign' => 'id'));

        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}